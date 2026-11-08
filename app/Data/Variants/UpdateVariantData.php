<?php

declare(strict_types=1);

namespace App\Data\Variants;

use App\Models\Variant;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateVariantData implements Arrayable
{
    public function __construct(
        public string $name,
        public string $url,
        public ?int $weight,
        public bool $isControl,
        public Variant $variant,
    ) {
    }

    public static function fromArray(
        Variant $variant,
        array $attributes,
    ): UpdateVariantData {
        $weight = $attributes['weight'];

        return new self(
            name: $attributes['name'],
            url: $attributes['url'],
            weight: filled($weight) ? $weight : null,
            isControl: $attributes['is_control'],
            variant: $variant,
        );
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public static function rules(): array
    {
        return CreateVariantData::rules();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'weight' => $this->weight,
            'is_control' => $this->isControl,
            'variant' => $this->variant->toArray(),
        ];
    }
}
