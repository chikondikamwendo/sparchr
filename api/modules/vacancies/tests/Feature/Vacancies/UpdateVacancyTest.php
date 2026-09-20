<?php

use App\Models\User;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Vacancy;

test('upates existing vacancy', function () {
    $user = User::factory()->create();
    $vacancy = Vacancy::factory()->for($user)->create([
        'title' => 'Sfot ENi',
        'status' => VacancyStatus::DRAFT,
    ]);

    $response = $this->actingAs($user)->patchJson('/v1/vacancies/'.$vacancy->slug, [
        'title' => 'Software Engineer',
        'status' => VacancyStatus::CLOSED,
    ]);

    $vacancy->refresh();

    $response->assertOk();

    expect($vacancy->title)->toBe('Software Engineer');
    expect($vacancy->status)->toBe(VacancyStatus::CLOSED);
});
