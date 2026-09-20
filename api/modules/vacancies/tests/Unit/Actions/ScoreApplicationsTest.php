<?php

use Sparc\Vacancies\Actions\ScoreApplications;
use Sparc\Vacancies\Ai\Agents\Recruiter;
use Sparc\Vacancies\Enums\ApplicationStatus as Status;
use Sparc\Vacancies\Models\Application;

test('it scores pending applications', function () {
    $application = Application::factory()->create();

    Recruiter::fake([
        [
            'results' => [
                [
                    'application_id' => $application->id,
                    'remarks' => 'Experience is unmatched',
                    'score' => 89,
                ],
            ],
        ],
    ]);

    (new ScoreApplications)->__invoke(new Recruiter);

    $application->refresh();

    expect($application->status)->toBe(Status::IN_REVIEW);
    expect($application->remarks)->toBe('Experience is unmatched');
    expect($application->score)->toBe(89);
});
