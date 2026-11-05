<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Sites;

use App\Data\Sites\CreateSiteData;
use App\Services\SiteService;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class CreateSiteForm extends Form
{
    public string $name;
    public string $domain;

    public function rules(): array
    {
        return CreateSiteData::rules();
    }

    public function save(): void
    {
        $attributes = $this->validate();

        $service = app(SiteService::class);

        $service->create(
            CreateSiteData::fromArray(
                user: Auth::user(),
                attributes: $attributes,
            ),
        );
    }
}
