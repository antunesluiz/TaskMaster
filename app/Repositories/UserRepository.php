<?php

namespace App\Repositories;

use App\Models\User;

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
}