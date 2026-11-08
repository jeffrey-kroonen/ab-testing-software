<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Variants;

use App\Data\Variants\CreateVariantData;
use App\Data\Variants\UpdateVariantData;
use App\Models\Experiment;
use App\Models\Variant;
use App\Services\VariantService;
use Livewire\Form;

class CreateVariantForm extends Form
{
    public string $name = '';
    public string $key = '';
    public string $url = '';
    public ?int $weight = 50;
    public bool $is_control = true;

    public function rules(): array
    {
        return CreateVariantData::rules();
    }

    public function hydrateFromVariant(Variant $variant): void
    {
        $this->name = $variant->name;
        $this->url = $variant->url;
        $this->weight = $variant->weight;
        $this->is_control = $variant->is_control;
    }

    public function save(
        Experiment $experiment,
        ?Variant $variant = null,
    ): Variant {
        $attributes = $this->validate();

        $service = app(VariantService::class);

        return $variant === null
            ? $service->create(
                CreateVariantData::fromArray(
                    experiment: $experiment,
                    attributes: $attributes,
                )
            )
            : $service->update(
                UpdateVariantData::fromArray(
                    variant: $variant,
                    attributes: $attributes,
                )
            );
    }
}
