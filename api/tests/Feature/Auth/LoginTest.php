<?php

use App\Models\User;

test("user can login", function () {
    $user = User::factory()->create();

    $response = $this->post('/v1/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk();
    $response->assertHeader('set-cookie');

    $this->assertAuthenticated();

    expect($response->json())->toEqual([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);
});

describe("validation", function () {
    todo("requires email");
    todo("requires correct email");
    todo("requires correct password");
});