<?php

namespace Sparc\Vacancies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Experience;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'application_id' => Application::factory(),
            'institution' => fake()->company(),
            'position' => fake()->sentence(),
            'started_at' => fake()->date('m-Y'),
            'ended_at' => fake()->date('m-Y'),
        ];
    }
}
