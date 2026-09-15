<?php

use App\Models\User;
use Sparc\Vacancies\Models\Vacancy;

$data = [
    'slug' => 'test-vacancy',
    'title' => 'Test Vacancy',
    'brief' => 'This is a test vacancy',
];

test('user can create a vacancy', function () use ($data) {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/v1/vacancies', $data);

    $response->assertCreated();

    $this->assertDatabaseHas(Vacancy::class, [
        'user_id' => $user->id,
        ...$data,
    ]);
});

describe('validation', function () use ($data) {
    test('checks required fields', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies');

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'slug',
            'title',
            'brief',
        ]);

        $this->assertDatabaseEmpty(Vacancy::class);
    });

    test('requires slug to be unique', function () use ($data) {
        $user = User::factory()->create();
        $vacancy = Vacancy::factory()->create();

        $response = $this->actingAs($user)->postJson('/v1/vacancies', array_merge(
            $data,
            ['slug' => $vacancy->slug]
        ));

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['slug']);

        $this->assertDatabaseCount(Vacancy::class, 1);
    });
});

describe('authentication & authorization', function () {
    test('requires user to be authenticated', function () {
        $response = $this->postJson('/v1/vacancies');

        $response->assertUnauthorized();
    });

    todo('requires permission');
});