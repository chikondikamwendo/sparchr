<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Sparc\Vacancies\Models\Vacancy;

test('lists available vacancies', function () {
    $user = User::factory()->create();
    Vacancy::factory()->for($user)->count(10)->create();

    $response = $this->actingAs($user)->getJson('/v1/vacancies');

    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        return $json
            ->has('total')
            ->has('path')
            ->has('per_page')
            ->has('next')
            ->has('prev')
            ->has('items', 10);
    });
});

todo('filters');
