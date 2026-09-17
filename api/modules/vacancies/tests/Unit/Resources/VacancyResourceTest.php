<?php

use Sparc\Vacancies\Http\Resources\VacancyResource;
use Sparc\Vacancies\Models\Vacancy;

test('serializes correct fields', function () {
    $vacancy = Vacancy::factory()->create();

    $parsed = VacancyResource::make($vacancy)->jsonSerialize();

    expect($parsed)->toEqual([
        'id' => $vacancy->id,
        'slug' => $vacancy->slug,
        'title' => $vacancy->title,
        'brief' => $vacancy->brief,
        'status' => $vacancy->status,
        'expires_at' => $vacancy->expires_at,
        'created_at' => $vacancy->created_at,
    ]);
});
