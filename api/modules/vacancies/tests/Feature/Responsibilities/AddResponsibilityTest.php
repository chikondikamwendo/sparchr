<?php

use App\Models\User;
use Sparc\Vacancies\Models\Responsibility;
use Sparc\Vacancies\Models\Vacancy;

$responsibilites = [
    ['title' => "Develop API's"],
    ['title' => 'Develop Frontend Apps', 'description' => 'Using Reactjs'],
];

test('adds responsibility to vacancy', function () use ($responsibilites) {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/responsibilities', [
        'responsibilities' => $responsibilites,
    ]);

    $response->assertCreated();

    $this->assertDatabaseCount(Responsibility::class, 2);
});

describe('validation', function () {
    test('requires responsibilities array', function () {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/responsibilities');

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('responsibilities');

        $this->assertDatabaseEmpty(Responsibility::class);
    });

    test('requires responsibility title', function () {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/responsibilities', [
            'responsibilities' => [
                ['description' => 'This is a responsibility description'],
            ],
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('responsibilities.0.title');

        $this->assertDatabaseEmpty(Responsibility::class);
    });
});

describe('authentication & authorization', function () {
    test('requires authentication', function () {
        $response = $this->postJson('/v1/vacancies/test-vacancy/responsibilities');

        $response->assertUnauthorized();

        $this->assertDatabaseEmpty(Responsibility::class);
    });

    todo('requires permission');
});
