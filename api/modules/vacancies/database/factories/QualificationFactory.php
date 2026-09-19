<?php

namespace Sparc\Vacancies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Enums\QualificationLevel;
use Sparc\Vacancies\Models\Qualification;
use Sparc\Vacancies\Models\Vacancy;

/**
 * @extends Factory<Qualification>
 */
class QualificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'qualificationable_id' => Vacancy::factory(),
            'qualificationable_type' => Vacancy::class,
            'field' => fake()->randomElement(['ICT', 'Accounting']),
            'level' => fake()->randomElement(QualificationLevel::cases()),
            'required' => fake()->boolean(),
        ];
    }
}
