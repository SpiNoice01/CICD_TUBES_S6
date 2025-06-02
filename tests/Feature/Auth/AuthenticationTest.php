<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->assertAuthenticatedAs($user);

    dd(
        $user->makeVisible('password')->toArray(), // Shows the actual stored password hash
        auth()->check(), // Shows if Laravel thinks you're authenticated
        session()->all() // Shows session data
    );
});




test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password')
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post('/logout');
    $this->assertGuest();
    $response->assertRedirect('/');
});
