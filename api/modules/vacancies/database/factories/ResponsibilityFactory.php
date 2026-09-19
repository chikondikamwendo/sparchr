<?php

namespace Sparc\Vacancies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Responsibility;
use Sparc\Vacancies\Models\Vacancy;

/**
 * @extends Factory<Responsibility>
 */
class ResponsibilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'responsibilitable_id' => Vacancy::factory(),
            'responsibilitable_type' => Vacancy::class,
            'title' => fake()->sentence(),
            'description' => fake()->sentences(asText: true),
        ];
    }
}
