<?php

use App\Models\User;

test('user can login', function () {
    $user = User::factory()->create();

    $response = $this->post('/v1/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk();
    $response->assertHeader('set-cookie');
    $response->assertJson([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);

    $this->assertAuthenticated();
});

describe('validation', function () {
    test('requires email and password', function () {
        $response = $this->post('/v1/login');

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email', 'password']);
    });

    test('requires correct email', function () {
        $response = $this->post('/v1/login', [
            'email' => 'no-user@example.test',
            'password' => 'password',
        ]);

        $response->assertUnauthorized();
        $response->assertJson(['email' => 'Invalid credentials']);
    });

    test('requires correct password', function () {
        $user = User::factory()->create();

        $response = $this->post('/v1/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertUnauthorized();
        $response->assertJson(['email' => 'Invalid credentials']);
    });
});
