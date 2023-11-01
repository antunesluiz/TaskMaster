<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Retrieve a user by their email.
     *
     * @param string $email The email address to search for.
     * @return \App\Models\User|null The User model or null if not found.
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Update the user's password.
     *
     * @param User $user
     * @param string $password
     * @return void
     */
    public function updatePassword(User $user, string $password): void
    {
        $user->password = Hash::make($password);
        $user->save();
    }
}