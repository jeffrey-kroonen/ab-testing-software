<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Variant>
 */
class VariantFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(asText: true),
            'url' => $this->faker->url(),
            'weight' => $this->faker->randomElement(
                range(10, 100, 10),
            ),
            'is_control' => $this->faker->boolean(),
        ];
    }
}
