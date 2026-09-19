<?php

use Sparc\Vacancies\Enums\QualificationLevel;
use Sparc\Vacancies\Models\Achievement;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Experience;
use Sparc\Vacancies\Models\Qualification;
use Sparc\Vacancies\Models\Requirement;
use Sparc\Vacancies\Models\Responsibility;
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
        'API development',
        'Infrastructure as code',
        'DevOps',
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

function createVacancy(): Vacancy
{
    $vacancy = Vacancy::factory()->create();

    Qualification::factory()->count(2)->create([
        'qualificationable_id' => $vacancy->id,
        'qualificationable_type' => Vacancy::class,
    ]);

    Responsibility::factory()->count(3)->create([
        'responsibilitable_id' => $vacancy->id,
        'responsibilitable_type' => Vacancy::class,
    ]);

    Requirement::factory()->for($vacancy)->count(3)->create();

    return $vacancy;
}

test('creates an application to a vacancy', function () use ($body) {
    $vacancy = createVacancy();

    $response = $this->postJson('/v1/vacancies/'.$vacancy->slug.'/applications', $body);

    $response->assertCreated();

    $this->assertDatabaseCount(Application::class, 1);
    $this->assertDatabaseCount(Qualification::class, 3);
    $this->assertDatabaseCount(Responsibility::class, 5);
    $this->assertDatabaseCount(Experience::class, 1);
    $this->assertDatabaseCount(Achievement::class, 1);
    $this->assertDatabaseCount(Skill::class, 3);
});

describe('validation', function () {
    todo('requires name');
    todo('requires email');
    todo('requires email to be unique');
    todo('email has to be unique for a single vacancy');
    todo('requires gender');
    todo('requires date of birth');
    todo('requires bio');
    todo('requires experiences');
    todo('requires skills');
    todo('requires qualifications');
    todo('rejects late submission');
});

describe('pipeline', function () {
    todo('sends email to acknowledge receipt');
    todo('scores application');
});
