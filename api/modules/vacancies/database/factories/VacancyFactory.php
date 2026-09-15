<?php

namespace Sparc\Vacancies\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Vacancy;

/**
 * @extends Factory<Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'slug' => fake()->unique()->slug(),
            'title' => fake()->sentence(),
            'brief' => fake()->sentences(asText: true),
        ];
    }
}
