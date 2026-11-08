<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Sites;

use App\Models\Site;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public Site $site;

    public function mount(Site $site): void
    {
        $this->site = $site;
    }

    #[Computed()]
    public function experiments(): LengthAwarePaginator
    {
        return $this->site
            ->experiments()
            ->paginate();
    }

    public function render(): View
    {
        return view('livewire.pages.sites.show');
    }
}
