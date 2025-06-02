<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('users can authenticate', function () {
    // Clear any previous sessions
    $this->flushSession();

    $user = User::factory()->create([
        'password' => Hash::make('password')
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    // Debug statements
    dump([
        'Status' => $response->getStatusCode(),
        'Redirect' => $response->headers->get('Location'),
        'Authenticated' => auth()->check(),
        'Session' => session()->all(),
        'User' => auth()->user()?->toArray()
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
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
