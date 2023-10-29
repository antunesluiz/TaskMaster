<?php

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Auth\AuthService;

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