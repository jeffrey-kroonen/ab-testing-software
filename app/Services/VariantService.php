<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Variants\CreateVariantData;
use App\Data\Variants\UpdateVariantData;
use App\Models\Experiment;
use App\Models\Variant;
use Illuminate\Support\Arr;

class VariantService
{
    public function determineVariantForVisitor(
        Experiment $experiment,
    ): Variant {
        $variants = $experiment->load('variants')
            ->variants;
        $values = $variants->map(fn (Variant $variant) => $variant->weight);

        $total = 0;
        $initialRandomizer = mt_rand(1, 100);

        foreach ($values as $weight) {
            $total += $weight;
        }

        $randomizer = ($initialRandomizer / 100) * $total;

        $bucket = 0;
        $currentTotal = 0;

        foreach ($values as $weight) {
            $currentTotal += $weight;

            if ($randomizer <= $currentTotal) {
                break;
            }

            $bucket++;
        }

        return $variants[$bucket];
    }

    public function create(CreateVariantData $data): Variant
    {
        $attributes = Arr::only($data->toArray(), [
            'name',
            'key',
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
            'key',
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
