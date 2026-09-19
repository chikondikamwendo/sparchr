<?php

namespace Sparc\Vacancies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Skill;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
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
            'title' => fake()->sentence(),
            'description' => fake()->sentences(asText: true),
        ];
    }
}
