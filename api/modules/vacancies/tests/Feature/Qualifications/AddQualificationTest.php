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
    todo('requires qualifications array');
    todo('requires qualification field');
    todo('requires qualification level');
    todo('requires to specify if mandatory');
});

describe('authentication & authorization', function () {
    todo('requires authenticatoin');
    todo('requires permission');
});
