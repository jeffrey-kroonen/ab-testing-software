<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Sites\CreateSiteData;
use App\Models\Site;
use Illuminate\Support\Arr;

class SiteService
{
    public function create(CreateSiteData $data): Site
    {
        $attributes = Arr::only($data->toArray(), [
            'name',
            'domain',
        ]);

        return $data->user
            ->sites()
            ->create($attributes);
    }
}
