<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Expirments\CreateExperimentData;
use App\Data\Expirments\UpdateExperimentData;
use App\Models\Experiment;
use Illuminate\Support\Arr;

class ExperimentService
{
    public function create(CreateExperimentData $data): Experiment
    {
        $attributes = Arr::only($data->toArray(), [
            'name',
            'key',
            'description',
            'status',
        ]);

        return $data->site
            ->experiments()
            ->create($attributes);
    }

    public function update(UpdateExperimentData $data): Experiment
    {
        $attributes = Arr::only($data->toArray(), [
            'name',
            'key',
            'description',
            'status',
        ]);

        $data->experiment
            ->update($attributes);

        return $data->experiment;
    }

    public function delete(Experiment $experiment): bool
    {
        return (bool) $experiment->delete();
    }
}
