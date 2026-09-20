<?php

use App\Models\User;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Vacancy;

test('changes status to closed if not closed/canceled', function () {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create();

    $response = $this->actingAs($user)->getJson('/v1/vacancies/'.$vacancy->slug.'/resolve');
    $vacancy->refresh();

    $response->assertNoContent();

    expect($vacancy->status)->toBe(VacancyStatus::CLOSED);
});

todo('changes application status to rejected if not changed');

todo('broadcasts result emails');
