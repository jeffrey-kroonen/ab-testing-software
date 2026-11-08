<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Sites\CreateSiteData;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class SiteService
{
    public function get(User $user): Collection
    {
        return $user->sites()->get();
    }

    public function findByClientId(string $clientId): ?Site
    {
        return Site::query()
            ->firstWhere('client_id', $clientId);
    }

    public function create(CreateSiteData $data): Site
    {
        $attributes = Arr::only($data->toArray(), [
            'client_id',
            'name',
            'domain',
        ]);

        return $data->user
            ->sites()
            ->create($attributes);
    }
}
