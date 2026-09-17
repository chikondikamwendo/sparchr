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
    todo('requires responsibilities array');
    todo('requires responsibility title');
});

describe('authentication & authorization', function () {
    todo('requires authentication');
    todo('requires permission');
});
