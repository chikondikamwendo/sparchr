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
    todo('requires requirements array');
    todo('requires requirement title');
});

describe('authorization & authentication', function () {
    todo('requires authentication');
    todo('requires permission');
});
