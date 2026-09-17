<?php

use App\Models\User;
use Sparc\Vacancies\Models\Requirement;
use Sparc\Vacancies\Models\Vacancy;

$requirements = [
    ['title' => 'Proficient in Laravel'],
    ['title' => 'Proficient in TS', 'description' => 'We use typescript for type safety'],
];

test('adds requirements to vacancy', function () use ($requirements) {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/requirements', [
        'requirements' => $requirements,
    ]);

    $response->assertCreated();

    $this->assertDatabaseCount(Requirement::class, 2);
});

describe('validation', function () {
    test('requires requirements array', function () {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/requirements', [
            'requirements' => [],
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('requirements');

        $this->assertDatabaseEmpty(Requirement::class);
    });

    test('requires requirement title', function () {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/requirements', [
            'requirements' => [
                ['description' => 'This is a requirement description'],
            ],
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('requirements.0.title');

        $this->assertDatabaseEmpty(Requirement::class);
    });
});

describe('authorization & authentication', function () {
    test('requires authentication', function () {
        $response = $this->postJson('/v1/vacancies/test-vacancy/requirements');

        $response->assertUnauthorized();

        $this->assertDatabaseEmpty(Requirement::class);
    });

    todo('requires permission');
});
