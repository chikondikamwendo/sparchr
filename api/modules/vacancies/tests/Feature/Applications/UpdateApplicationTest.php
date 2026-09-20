<?php

use App\Models\User;
use Sparc\Vacancies\Enums\ApplicationStatus;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

test('updates application status', function () {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();
    $application = Application::factory()->for($vacancy)->create([
        'status' => ApplicationStatus::SHORTLISTED,
    ]);

    $response = $this->actingAs($user)->patchJson(
        '/v1/vacancies/'.$vacancy->slug.'/applications/'.$application->id,
        [
            'status' => ApplicationStatus::ACCEPTED,
        ]
    );

    $application->refresh();

    $response->assertOk();

    expect($application->status)->toBe(ApplicationStatus::ACCEPTED);
});
