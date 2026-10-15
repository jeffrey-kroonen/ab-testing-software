<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Experiments\Status;
use App\Models\Experiment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends Factory<Experiment>
 */
class ExperimentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = $this->faker
            ->optional()
            ->dateTimeBetween(
                startDate: '-3 months',
                endDate: '+3 months',
            );

        $endedAt = $startedAt !== null && $this->faker->boolean()
            ? Carbon::parse($startedAt)->add('+2 months')
            : null;

        return [
            'name' => $this->faker->words(asText: true),
            'description' => $this->faker->optional()->sentence(),
            'key' => Str::random(32),
            'status' => Status::DRAFT,
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
        ];
    }
}
