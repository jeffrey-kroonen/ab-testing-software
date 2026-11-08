<?php

declare(strict_types=1);

namespace App\Data\Expirments;

use App\Enums\Experiments\Status;
use App\Models\Site;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class CreateExperimentData implements Arrayable
{
    public function __construct(
        public string $name,
        public string $key,
        public ?string $description,
        public Status $status,
        public Site $site,
    ) {
    }

    public static function fromArray(
        Site $site,
        array $attributes,
    ): static {
        $description = $attributes['description'];

        return new self(
            name: $attributes['name'],
            key: $attributes['key'],
            description: filled($description) ? $description : null,
            status: $attributes['status'] ?? Status::DRAFT,
            site: $site,
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
            'key' => [
                'required',
                'string',
                'min:2',
                'max:150',
            ],
            'description' => [
                'nullable',
                'string',
                'min:2',
                'max:500',
            ],
            'status' => [
                'required',
                Rule::enum(Status::class),
            ],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'key' => $this->key,
            'description' => $this->description,
            'status' => $this->status->value,
            'site' => $this->site->toArray(),
        ];
    }
}
