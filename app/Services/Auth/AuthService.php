<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * AuthService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate the user with given credentials.
     *
     * @param array $credentials
     * @return array|JsonResponse
     */
    public function login(array $credentials): array|JsonResponse
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth-token');

        return ['token' => $token->plainTextToken];
    }

    /**
     * Logout the authenticated user.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
