<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Register a new user and generate an authentication token.
     *
     * @param array $validatedData An array containing the 'name', 'email', and 'password'.
     * @return array Returns an array with a 'user' object and a 'token' string.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(array $validatedData): array
    {
        $user = $this->userRepository->create($validatedData);

        $token = $user->createToken('auth-token');

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

    /**
     * Handle user password reset request.
     *
     * @param array $credentials
     * @return string
     */
    public function forgotPassword(array $credentials): string
    {
        return Password::sendResetLink($credentials);
    }

    /**
     * Reset the user's password.
     *
     * @param array $credentials
     * @return string
     */
    public function resetPassword(array $credentials): string
    {
        return Password::reset($credentials, function ($user, $password) {
            $this->userRepository->updatePassword($user, $password);
        });
    }
}
