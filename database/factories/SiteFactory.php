<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Site>
 */
class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => $this->faker->uuid(),
            'name' => $this->faker->company(),
            'domain' => $this->faker->domainName(),
        ];
    }
}
