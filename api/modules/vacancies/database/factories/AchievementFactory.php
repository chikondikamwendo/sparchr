<?php

namespace Sparc\Vacancies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Achievement;
use Sparc\Vacancies\Models\Experience;

/**
 * @extends Factory<Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'experience_id' => Experience::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->sentences(asText: true),
        ];
    }
}
