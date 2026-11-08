<?php

declare(strict_types=1);

namespace App\Data\Expirments;

use App\Enums\Experiments\Status;
use App\Models\Experiment;
use Illuminate\Contracts\Support\Arrayable;

class UpdateExperimentData implements Arrayable
{
    public function __construct(
        public string $name,
        public string $key,
        public ?string $description,
        public Status $status,
        public Experiment $experiment,
    ) {
    }

    public static function fromArray(
        Experiment $experiment,
        array $attributes,
    ): static {
        $description = $attributes['description'];

        return new self(
            name: $attributes['name'] ?? $experiment->name,
            key: $attributes['key'] ?? $experiment->key,
            description: filled($description) ? $description : $experiment->description,
            status: $attributes['status'] ?? $experiment->status,
            experiment: $experiment,
        );
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public static function rules(): array
    {
        return CreateExperimentData::rules();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'key' => $this->key,
            'description' => $this->description,
            'status' => $this->status->value,
            'experiment' => $this->experiment->toArray(),
        ];
    }
}
