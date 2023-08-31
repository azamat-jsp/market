<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\User\Requests\StoreRequest;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Requests\UpdateRequest;
use App\Tbuy\User\Resources\UserResource;
use App\Tbuy\User\Services\UserService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Админ
 * @subgroup Пользователи
 * @authenticated
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    /**
     * Получить список пользователей
     *
     * @responseFile storage/responses/user/index.json
     *
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        $users = $this->userService->get();

        return new SuccessResponse(
            response: UserResource::collection($users),
            message: 'Список пользователей'
        );
    }

    /**
     * Создать нового пользователя
     *
     * @bodyParam name required string Имя пользователя. Example: Генадий
     * @bodyParam email required string E-mail пользователя. Example: test@test.com
     * @bodyParam password required string Пароль пользователя. Example: F3qTY!43#YH5
     * @bodyParam password_confirmation required string Подтверждение пароля пользователя. Example: F3qTY!43#YH5
     *
     * @responseFile storage/responses/user/store.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/target/validation-failed.json
     *
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(StoreRequest $request): SuccessResponse
    {
        $user = $this->userService->store($request->toDto());

        return new SuccessResponse(
            response: UserResource::make($user),
            status: ResponseAlias::HTTP_CREATED,
            message: 'Пользователь успешно создан'
        );
    }

    /**
     * Получить полную информацию о пользователе
     *
     * @urlParam id integer required ID рассылки. Example: 1
     *
     * @responseFile storage/responses/user/show.json
     *
     * @param User $user
     * @return SuccessResponse
     */
    public function show(User $user): SuccessResponse
    {
        return new SuccessResponse(
            response: UserResource::make($user),
            message: 'Полная информация о пользователе'
        );
    }

    /**
     * Обновить информацию о пользователе
     *
     * @urlParam id integer required ID рассылки. Example: 1
     *
     * @bodyParam name required string Имя пользователя. Example: Генадий
     * @bodyParam email required string E-mail пользователя. Example: test@test.com
     * @bodyParam password required string Пароль пользователя. Example: F3qTY!43#YH5
     * @bodyParam password_confirmation required string Подтверждение пароля пользователя. Example: F3qTY!43#YH5
     *
     * @responseFile storage/responses/user/update.json
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return SuccessResponse
     */
    public function update(UpdateRequest $request, User $user): SuccessResponse
    {
        $user = $this->userService->update($user, $request->toDto());

        return new SuccessResponse(
            response: UserResource::make($user),
            message: 'Пользователь успешно обновлен'
        );
    }

    /**
     * Удалить пользователя
     *
     * @urlParam id integer required ID рассылки. Example: 1
     *
     * @responseFile storage/responses/user/destroy.json
     *
     * @param User $user
     * @return SuccessEmptyResponse
     */
    public function destroy(User $user): SuccessEmptyResponse
    {
        $this->userService->delete($user);

        return new SuccessEmptyResponse(
            message: 'Пользователь успешно удален'
        );
    }
}
