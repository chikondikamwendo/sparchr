<?php

use App\Models\User;

test('user can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/v1/logout');

    $response->assertNoContent();
    $response->assertHeader('set-cookie');

    $this->assertGuest('api');
});
