<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Sparc\Vacancies\Models\Qualification;
use Sparc\Vacancies\Models\Requirement;
use Sparc\Vacancies\Models\Responsibility;
use Sparc\Vacancies\Models\Vacancy;

test('shows a vacancy with all info', function () {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    Requirement::factory()->for($vacancy)->count(4)->create();

    Responsibility::factory()->count(5)->create([
        'responsibilitable_id' => $vacancy->id,
        'responsibilitable_type' => Vacancy::class,
    ]);

    Qualification::factory()->count(3)->create([
        'qualificationable_id' => $vacancy->id,
        'qualificationable_type' => Vacancy::class,
    ]);

    $response = $this->actingAs($user)->getJson('/v1/vacancies/'.$vacancy->slug);

    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        $json->has('id')
            ->has('slug')
            ->has('title')
            ->has('brief')
            ->has('status')
            ->has('expires_at')
            ->has('created_at')
            ->has('department')
            ->has('responsibilities', 5)
            ->has('requirements', 4)
            ->has('qualifications', 3);
    });
});
