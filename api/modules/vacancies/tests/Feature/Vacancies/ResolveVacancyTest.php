<?php

use App\Models\User;
use Sparc\Vacancies\Enums\ApplicationStatus;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

test('changes status to closed if not closed/canceled', function () {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    $response = $this->actingAs($user)->getJson('/v1/vacancies/'.$vacancy->slug.'/resolve');
    $vacancy->refresh();

    $response->assertNoContent();

    expect($vacancy->status)->toBe(VacancyStatus::CLOSED);
});

test('changes pending applications status to rejected if not changed', function () {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    Application::factory()->for($vacancy)->count(3)->create([
        'status' => ApplicationStatus::IN_REVIEW,
    ]);

    Application::factory()->for($vacancy)->count(3)->create([
        'status' => ApplicationStatus::SHORTLISTED,
    ]);

    Application::factory()->for($vacancy)->create(['status' => ApplicationStatus::ACCEPTED]);
    Application::factory()->for($vacancy)->create(['status' => ApplicationStatus::WAITLISTED]);

    $response = $this->actingAs($user)->getJson('/v1/vacancies/'.$vacancy->slug.'/resolve');

    $response->assertNoContent();

    $hasPendingApplications = Application::query()
        ->whereIn('status', ApplicationStatus::pending())
        ->exists();

    $rejectedApplicationsCount = Application::query()
        ->where('status', ApplicationStatus::REJECTED)
        ->count();

    expect($hasPendingApplications)->toBeFalse();
    expect($rejectedApplicationsCount)->toBe(6);
});

todo('broadcasts result emails');
