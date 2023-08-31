<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Company\Requests\ChangePasswordRequest;
use App\Tbuy\Company\Requests\ForgotPasswordRequest;
use App\Tbuy\Company\Resources\CompanyResource;
use App\Tbuy\Company\Services\CompanyService;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Requests\LoginRequest;
use App\Tbuy\User\Requests\ResetPasswordRequest;
use App\Tbuy\User\Resources\LoginResource;
use App\Tbuy\User\Services\Auth\AuthService;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

/**
 * @group Клиент
 * @subgroup Авторизация
 */
class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService    $authService,
        private readonly CompanyService $companyService,
    )
    {
    }

    /**
     * Вход
     *
     * @bodyParam email string required Email. Example: backend@admin.com
     * @bodyParam password string required Пароль. Example: password
     * @responseFile storage/responses/auth/login.json
     * @responseFile status=401 scenario="Login failed" storage/responses/auth/login-failed.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/auth/validation-failed.json
     * @param LoginRequest $request
     * @return SuccessResponse|ErrorResponse
     */
    public function login(LoginRequest $request): SuccessResponse|ErrorResponse
    {
        if ($user = $this->authService->login($request->all())) {

            return new SuccessResponse(
                response: LoginResource::make([
                    'user' => $user,
                    'access_token' => $user->createToken('authClientToken')->plainTextToken
                ]),
                message: 'Login success'
            );
        }

        return new ErrorResponse(
            message: 'Login failed',
            status: 401
        );
    }

    /**
     * Выход
     *
     * @authenticated
     * @responseFile storage/responses/auth/logout.json
     * @param Request $request
     * @return SuccessEmptyResponse
     */
    public function logout(Request $request): SuccessEmptyResponse
    {
        $this->authService->logout($request);

        return new SuccessEmptyResponse(
            message: 'Logout success'
        );
    }

    /**
     * Авторизованный компания
     *
     * @authenticated
     * @responseFile storage/responses/auth/company.json
     * @return SuccessResponse
     */
    public function getAuthCompany(): SuccessResponse
    {
        $company = $this->companyService->getAuthCompany();

        return new SuccessResponse(
            response: CompanyResource::make($company),
            message: 'Information about the authorized company'
        );
    }

    /**
     * Сменить пароль
     *
     * @authenticated
     * @bodyParam old_password string required Пароль. Example: password
     * @bodyParam password string required Новый Пароль. Example: password2
     * @bodyParam password_confirmation string required Новый Пароль Подтверждение. Example: password2
     * @responseFile storage/responses/auth/change-password.json
     * @responseFile status=422 storage/responses/auth/change-password-validation-failed.json
     *
     * @param ChangePasswordRequest $request
     * @return SuccessEmptyResponse|ErrorResponse
     */
    public function changePassword(ChangePasswordRequest $request): SuccessEmptyResponse|ErrorResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $success = $this->authService->changePassword($user, $request->toDTO());

        if ($success) {
            return new SuccessEmptyResponse(
                message: 'Password changed successfully',
            );
        }

        return new ErrorResponse(
            message: 'Password change failed with error',
            status: 422
        );
    }

    /**
     * Забыл пароль
     *
     * @bodyParam email string required Email.
     * @responseFile storage/responses/auth/forgot-password.json
     *
     * @param ForgotPasswordRequest $request
     * @return SuccessEmptyResponse|ErrorResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): SuccessEmptyResponse|ErrorResponse
    {
        $status = $this->authService->forgotPassword($request->toDto());

        if ($status == PasswordBroker::RESET_THROTTLED) {
            return new ErrorResponse(
                message: 'You have already sent a request to change your password',
                status: 422
            );
        }

        if ($status == PasswordBroker::INVALID_USER) {
            return new ErrorResponse(
                message: 'Invalid email',
                status: 422,
            );
        }

        return new SuccessEmptyResponse(
            message: 'А password recovery email has been sent'
        );
    }

    /**
     * Забыл пароль
     *
     * @bodyParam email string required Email.
     * @bodyParam token string required Токен отправилась емейлу.
     * @bodyParam password required string Пароль пользователя. Example: F3qTY!43#YH5
     * @bodyParam password_confirmation required string Подтверждение пароля пользователя. Example: F3qTY!43#YH5
     *
     * @param ResetPasswordRequest $request
     * @return Responsable
     */
    public function resetPassword(ResetPasswordRequest $request): Responsable
    {
        $status = $this->authService->resetPassword($request->toDto());

        if ($status == PasswordBroker::INVALID_USER) {
            return new ErrorResponse(
                message: 'Invalid email',
                status: 422,
            );
        }

        if ($status == PasswordBroker::INVALID_TOKEN) {
            return new ErrorResponse(
                message: 'Invalid token',
                status: 422,
            );
        }

        return new SuccessEmptyResponse(
            message: 'Password reset successfully'
        );
    }
}
