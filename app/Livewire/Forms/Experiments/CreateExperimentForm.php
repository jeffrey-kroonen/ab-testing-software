<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Experiments;

use App\Data\Expirments\CreateExperimentData;
use App\Data\Expirments\UpdateExperimentData;
use App\Models\Experiment;
use App\Models\Site;
use App\Services\ExperimentService;
use Illuminate\Support\Arr;
use Livewire\Form;

class CreateExperimentForm extends Form
{
    public string $name = '';
    public string $key = '';
    public string $description = '';

    public function rules(): array
    {
        return Arr::except(CreateExperimentData::rules(), ['status']);
    }

    public function store(Site $site): Experiment
    {
        $attributes = $this->validate();

        $service = app(ExperimentService::class);

        return $service->create(
            CreateExperimentData::fromArray(
                site: $site,
                attributes: $attributes,
            ),
        );
    }

    public function update(Experiment $experiment): Experiment
    {
        $attributes = $this->validate();

        $service = app(ExperimentService::class);

        return $service->update(
            UpdateExperimentData::fromArray(
                experiment: $experiment,
                attributes: $attributes,
            ),
        );
    }
}
