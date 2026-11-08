<?php

declare(strict_types=1);

namespace App\Data\Variants;

use App\Models\Experiment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateVariantData implements Arrayable
{
    public function __construct(
        public string $name,
        public string $url,
        public ?int $weight,
        public bool $isControl,
        public Experiment $experiment,
    ) {
    }

    public static function fromArray(
        Experiment $experiment,
        array $attributes,
    ): CreateVariantData {
        $weight = $attributes['weight'];

        return new self(
            name: $attributes['name'],
            url: $attributes['url'],
            weight: filled($weight) ? $weight : null,
            isControl: $attributes['is_control'],
            experiment: $experiment,
        );
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:150',
            ],
            'url' => [
                'required',
                'active_url',
                'min:2',
                'max:150',
            ],
            'weight' => [
                'nullable',
                'integer',
                'min:10',
                'max:100',
            ],
            'is_control' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'weight' => $this->weight,
            'is_control' => $this->isControl,
            'experiment' => $this->experiment->toArray(),
        ];
    }
}
