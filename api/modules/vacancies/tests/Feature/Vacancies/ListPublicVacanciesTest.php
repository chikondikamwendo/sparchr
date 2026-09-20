<?php

use Illuminate\Testing\Fluent\AssertableJson;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Vacancy;

test('lists open vacancies', function () {
    Vacancy::factory()->count(5)->create(['status' => VacancyStatus::OPEN]);
    Vacancy::factory()->count(2)->create(['status' => VacancyStatus::DRAFT]);
    Vacancy::factory()->count(2)->create(['status' => VacancyStatus::IN_REVIEW]);
    Vacancy::factory()->count(2)->create(['status' => VacancyStatus::CLOSED]);

    $response = $this->getJson('/v1/public/vacancies');

    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        return $json
            ->has('total')
            ->has('path')
            ->has('per_page')
            ->has('next')
            ->has('prev')
            ->has('items', 5);
    });
});
