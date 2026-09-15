<?php

use App\Models\User;
use Sparc\Vacancies\Models\Vacancy;

$data = [
    'slug' => 'test-vacancy',
    'title' => 'Test Vacancy',
    'brief' => 'This is a test vacancy',
];

test('user can create a vacancy', function () use ($data) {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/v1/vacancies', $data);

    $response->assertCreated();
    
    $this->assertDatabaseHas(Vacancy::class, [
        'user_id' => $user->id,
        ...$data,
    ]);
});

describe('validation', function () {
    todo('checks required fields');
    todo('requires slug to be unique');
});

describe('authentication & authorization', function () {
    todo('requires user to be authenticated');
    todo('requires create permission');
});