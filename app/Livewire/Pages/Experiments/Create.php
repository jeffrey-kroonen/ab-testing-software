<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Experiments;

use App\Livewire\Forms\Experiments\CreateExperimentForm;
use App\Models\Experiment;
use App\Models\Site;
use App\Models\User;
use App\Models\Variant;
use App\Services\ExperimentService;
use App\Services\VariantService;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public CreateExperimentForm $experimentForm;

    public Site $site;
    public ?Experiment $experiment = null;
    public $variants = [];
    public ?int $variantIdToDelete = null;

    public string|int $step = 1;

    public string|int $nextStep = 2;

    public function mount(
        Request $request,
        Site $site,
    ): void {
        /** @var User $user */
        $user = $request->user();

        abort_if(
            boolean: ! $user->sites()->whereKey($site->id)->exists(),
            code: 403,
        );

        $this->site = $site;
    }

    public function saveExperiment(): void
    {
        $this->experiment = $this->experiment === null
            ? $this->experimentForm->store($this->site)
            : $this->experimentForm->update($this->experiment);

        $this->experiment->load('variants');

        $this->resolveStep();
    }

    public function dispatchVariantSubmission(): void
    {
        $this->dispatch(
            'variant-submitted',
            siteId: $this->site->id,
            experimentId: $this->experiment->id,
            isControl: $this->step === 2,
        );
    }

    public function complete(): void
    {
        $this->resolveStep();
    }

    public function previous(): void
    {
        if ($this->step === 1) {
            if ($this->experiment !== null) {
                app(ExperimentService::class)->delete($this->experiment);
            }

            $this->redirectRoute('sites.show', ['site' => $this->site->id]);
        }

        if ($this->step === 2) {
            $this->step = 1;
            $this->nextStep = 2;

            return;
        }

        if ($this->step === 3) {
            $this->step = 2;
            $this->nextStep = 3;
        }
    }

    public function deleteVariant(): void
    {
        $variant = $this->experiment
            ->variants
            ->first(fn (Variant $variant) => $variant->id === $this->variantIdToDelete);

        if ($variant === null) {
            return;
        }

        app(VariantService::class)->delete($variant);

        $this->experiment->refresh();

        Flux::modals()->close();
    }

    public function render(): View
    {
        return view('livewire.pages.experiments.create');
    }

    #[On('variant-saved')]
    public function resolveVariantsForExperimentAndStep(bool $resolveStep = false): void
    {
        $this->experiment->refresh();

        Flux::modals()->close();

        if ($resolveStep) {
            $this->resolveStep();
        }
    }

    private function resolveStep(): void
    {
        if ($this->step === 1) {
            $this->step = 2;
            $this->nextStep = 3;

            return;
        }

        if ($this->step === 2) {
            $this->step = 3;
            $this->nextStep = 'complete';

            return;
        }

        if ($this->step === 3) {
            $this->redirectRoute('sites.show', ['site' => $this->site->id]);
        }
    }
}
