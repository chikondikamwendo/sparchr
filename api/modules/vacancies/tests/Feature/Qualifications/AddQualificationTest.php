<?php

use App\Models\User;
use Sparc\Vacancies\Enums\QualificationLevel as Level;
use Sparc\Vacancies\Models\Qualification;
use Sparc\Vacancies\Models\Vacancy;

$qualifications = [
    ['field' => 'ICT', 'level' => Level::CERTIFICATE, 'required' => false],
    ['field' => 'ICT', 'level' => Level::DEGREE, 'required' => true],
];

test('adds qualification to vacancy', function () use ($qualifications) {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/qualifications', [
        'qualifications' => $qualifications,
    ]);

    $response->assertCreated();

    $this->assertDatabaseCount(Qualification::class, 2);
});

describe('validation', function () {
    test('requires qualifications array', function () {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/qualifications', [
            'qualifications' => [],
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('qualifications');

        $this->assertDatabaseEmpty(Qualification::class);
    });

    test('requires qualification required fields', function () {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies/'.$vacancy->slug.'/qualifications', [
            'qualifications' => [
                [],
            ],
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'qualifications.0.field',
            'qualifications.0.level',
            'qualifications.0.required',
        ]);

        $this->assertDatabaseEmpty(Qualification::class);
    });
});

describe('authentication & authorization', function () {
    test('requires authenticatoin', function () {
        $response = $this->postJson('/v1/vacancies/test-vacancy/qualifications');

        $response->assertUnauthorized();

        $this->assertDatabaseEmpty(Qualification::class);
    });

    todo('requires permission');
});
