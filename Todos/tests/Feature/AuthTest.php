<?php

// sign up 

it('it registers a user', function () {
    $response = $this->post('/api/auth/signup', [
        'name' => 'John Doe',
        'email' => fake()->email,
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);


    $response->assertStatus(201);

});


it('it logs in a user', function () {
    $response = $this->post('/api/auth/login', [
        'email' => 'jon@mail.com',
        'password' => 'password'
    ]);

    $response->assertStatus(201);
});

it('it logs out a user', function () {
    $response = $this->post('/api/auth/login', [
        'email' => 'jon@mail.com',
        'password' => 'password'
    ]);

    $response->assertStatus(201);

    $token = $response->headers->get('Authorization');

    $response = $this->withHeaders([
        'Authorization' => $token
    ])->post('/api/auth/logout');

    $response->assertStatus(200);
});

