<?php

use Illuminate\Support\Facades\Date;
use Sparc\Vacancies\Enums\QualificationLevel;
use Sparc\Vacancies\Models\Achievement;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Experience;
use Sparc\Vacancies\Models\Qualification;
use Sparc\Vacancies\Models\Responsibility;
use Sparc\Vacancies\Models\Skill;
use Sparc\Vacancies\Models\Vacancy;

$body = [
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
    'gender' => 'Female',
    'date_of_birth' => '19-09-1999',
    'bio' => 'Hard working self motivated girl.',
    'experiences' => [
        [
            'institution' => 'Acme Corp',
            'started_at' => '09-2023',
            'ended_at' => '09-2024',
            'position' => 'Software Developer',
            'responsibilities' => [
                ['title' => 'Develop backend systems'],
                ['title' => 'Develop API sdk\'s'],
            ],
            'achievements' => [
                ['title' => 'Deployed a self healing cloud dev env'],
            ],
        ],
    ],
    'skills' => [
        ['title' => 'API development'],
        ['title' => 'Infrastructure as code'],
        ['title' => 'DevOps'],
    ],
    'qualifications' => [
        [
            'field' => 'ICT',
            'level' => QualificationLevel::DEGREE,
            'year' => '2016',
            'institution' => 'University of Code',
        ],
    ],
];

test('creates an application to a vacancy', function () use ($body) {
    $vacancy = Vacancy::factory()->create();

    $response = $this->postJson('/v1/vacancies/'.$vacancy->slug.'/applications', $body);

    $response->assertCreated();

    $this->assertDatabaseCount(Application::class, 1);
    $this->assertDatabaseCount(Qualification::class, 1);
    $this->assertDatabaseCount(Responsibility::class, 2);
    $this->assertDatabaseCount(Experience::class, 1);
    $this->assertDatabaseCount(Achievement::class, 1);
    $this->assertDatabaseCount(Skill::class, 3);
});

describe('validation', function () use ($body) {
    test('checks required fields', function () {
        $vacancy = Vacancy::factory()->create();

        $response = $this->postJson('/v1/vacancies/'.$vacancy->slug.'/applications');

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'name',
            'email',
            'gender',
            'date_of_birth',
            'bio',
            'experiences',
            'skills',
            'qualifications',
        ]);

        $this->assertDatabaseEmpty(Application::class);
    });

    test('requires email to be unique', function () use ($body) {
        $vacancy = Vacancy::factory()->create();

        Application::factory()->for($vacancy)->create(['email' => $body['email']]);

        $response = $this->postJson('/v1/vacancies/'.$vacancy->slug.'/applications', $body);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('email');
    });

    test('email has to be unique for a single vacancy', function () use ($body) {
        $vacancy = Vacancy::factory()->create();

        Application::factory()->create(['email' => $body['email']]);

        $response = $this->postJson('/v1/vacancies/'.$vacancy->slug.'/applications', $body);

        $response->assertCreated();
    });

    test('rejects late submission', function () use ($body) {
        $vacancy = Vacancy::factory()->create([
            'expires_at' => Date::now()->subDays(2),
        ]);

        $response = $this->postJson('/v1/vacancies/'.$vacancy->slug.'/applications', $body);

        $response->assertNotFound();
    });
});

describe('pipeline', function () {
    todo('sends email to acknowledge receipt');
    todo('scores application');
});
