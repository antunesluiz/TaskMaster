<?php

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Auth\AuthService;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
   $this->user = User::factory()->create();
});

it('can login with valid credentials', function () {
   $response = (new AuthService(new UserRepository()))->login([
      'email' => $this->user->email,
      'password' => 'password'
   ]);

   expect($response)->toHaveKey('token');
});

it('login with wrong credentials', function () {
   $response = (new AuthService(new UserRepository()))->login([
      'email' => $this->user->email,
      'password' => 'wrong-password'
   ]);

   expect($response->getData())->toHaveKey('error');
});

it('can logout the user', function () {
   Sanctum::actingAs($this->user);

   $response = $this->postJson('/api/logout');

   $response->assertJson(['message' => 'Logged out successfully'])
      ->assertStatus(200);
});

it('cannout logout the user', function () {
   $response = $this->postJson('/api/logout');

   $response->assertJson(['message' => 'Unauthenticated.'])
      ->assertStatus(401);
});