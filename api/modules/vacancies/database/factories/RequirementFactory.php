<?php

namespace Sparc\Vacancies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Requirement;
use Sparc\Vacancies\Models\Vacancy;

/**
 * @extends Factory<Requirement>
 */
class RequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vacancy_id' => Vacancy::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->sentences(asText: true),
        ];
    }
}
