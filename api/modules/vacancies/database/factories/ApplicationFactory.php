<?php

namespace Sparc\Vacancies\Database\Factories;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
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
            'name' => fake()->name(),
            'gender' => fake()->randomElement(Gender::cases()),
            'date_of_birth' => fake()->date(),
            'bio' => fake()->sentences(asText: true),
            'email' => fake()->email(),
        ];
    }
}
