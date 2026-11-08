<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Variants\CreateVariantData;
use App\Data\Variants\UpdateVariantData;
use App\Models\Variant;
use Illuminate\Support\Arr;

class VariantService
{
    public function create(CreateVariantData $data): Variant
    {
        $attributes = Arr::only($data->toArray(), [
            'name',
            'url',
            'weight',
            'is_control',
        ]);

        return $data->experiment
            ->variants()
            ->create($attributes);
    }

    public function update(UpdateVariantData $data): Variant
    {
        $attributes = Arr::only($data->toArray(), [
            'name',
            'url',
            'weight',
            'is_control',
        ]);

        $data->variant
            ->update($attributes);

        return $data->variant;
    }

    public function delete(Variant $variant): bool
    {
        return (bool) $variant->delete();
    }
}
