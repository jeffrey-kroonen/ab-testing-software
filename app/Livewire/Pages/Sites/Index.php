<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Sites;

use App\Livewire\Forms\Sites\CreateSiteForm;
use App\Services\SiteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $sites = [];

    public CreateSiteForm $form;

    public function mount(
        Request $request,
        SiteService $service,
    ): void {
        $this->sites = $service->get($request->user());
    }

    public function createSite()
    {
        $this->form->save();

        $this->redirectRoute('sites.index');
    }

    public function render(): View
    {
        return view('livewire.pages.sites.index');
    }
}
