<?php

declare(strict_types=1);

namespace App\Livewire\Variants;

use App\Livewire\Forms\Variants\CreateVariantForm;
use App\Models\Site;
use App\Models\Variant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateVariant extends Component
{
    public CreateVariantForm $form;

    public ?Variant $variant;

    public function mount(?int $variantId = null)
    {
        if ($variantId === null) {
            return;
        }

        // TODO Check if this should refactored for security reasons.
        $this->variant = Variant::query()->find($variantId);

        $this->form->hydrateFromVariant($this->variant);
    }

    #[On('variant-submitted')]
    public function save(
        int $siteId,
        int $experimentId,
        bool $isControl
    ): void {
        // TODO Maybe simplify this, by checking if the experiment is related to the user.
        // Use the relate through method from Laravel.
        $site = Site::query()->findOrFail($siteId);

        $experiment = $site
            ->experiments()
            ->findOrFail($experimentId);

        $this->form->is_control = $isControl;

        $this->form->save(
            experiment: $experiment,
            variant: $this->variant ?? null,
        );

        $this->form->reset();

        $this->dispatch('variant-saved', resolveStep: $isControl);
    }

    public function render(): View
    {
        return view('livewire.variants.create-variant');
    }
}
