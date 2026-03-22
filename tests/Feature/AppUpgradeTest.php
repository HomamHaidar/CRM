<?php

use App\Models\User;

it('serves the login page', function () {
    $this->get('/')->assertStatus(200);
});

it('redirects guests away from dashboard', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

it('allows a user to login', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email'    => $user->email,
        'password' => 'password',
    ])->assertRedirect('/dashboard');
});

it('blocks login with wrong password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email'    => $user->email,
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');
});
