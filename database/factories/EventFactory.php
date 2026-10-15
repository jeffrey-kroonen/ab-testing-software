<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Events\EventType;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'visitor_id' => $this->faker->regexify('visitor-[A-Za-z0-9]{16}'),
            'event_type' => $this->faker->randomElement(EventType::cases()),
            'url' => $this->faker->url(),
        ];
    }
}
