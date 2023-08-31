<?php

namespace App\Tbuy\User\Services\Auth;

use App\Tbuy\User\DTOs\ChangePasswordDTO;
use App\Tbuy\User\DTOs\ForgotPasswordDTO;
use App\Tbuy\User\DTOs\ResetPasswordDTO;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Notifications\ChangePasswordNotification;
use App\Tbuy\User\Notifications\ForgotPasswordNotification;
use App\Tbuy\User\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthServiceImplementation implements AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository,
    )
    {
    }

    public function login($payload): ?User
    {
        if (auth()->attempt(['email' => $payload['email'], 'password' => $payload['password']])) {
            /** @var User $user */
            $user = auth()->user();
            return $user;
        }

        return null;
    }

    public function logout(Request $request): void
    {
        /**
         * @var User $user
         */
        $user = $request->user();
        $user->tokens()->delete();
    }

    public function create($payload): User
    {
        $user = User::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password'])
        ]);

        return $user;
    }

    public function getAuthUser(): Authenticatable
    {
        return auth()->user();
    }

    public function changePassword(User $user, ChangePasswordDTO $payload): bool
    {
        $success = $this->userRepository->changePassword($user, $payload);

        if ($success) {
            $user->notify(new ChangePasswordNotification($payload->password));
        }

        return $success;
    }

    public function forgotPassword(ForgotPasswordDTO $payload): string
    {
        return Password::sendResetLink([
            'email' => $payload->email,
        ], fn(User $user, string $token) => $user->notify(new ForgotPasswordNotification($token)));
    }

    public function resetPassword(ResetPasswordDTO $payload): string
    {
        return Password::reset([
            'email' => $payload->email,
            'token' => $payload->token,
            'password' => $payload->password,
        ], fn(User $user, string $password) => $user->update(['password' => Hash::make($password)]));
    }
}
