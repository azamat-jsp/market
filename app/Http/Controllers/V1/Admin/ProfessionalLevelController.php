<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use App\Tbuy\ProfessionalLevel\Requests\StoreRequest;
use App\Tbuy\ProfessionalLevel\Requests\UpdateRequest;
use App\Tbuy\ProfessionalLevel\Resources\ProfessionalLevelResource;
use App\Tbuy\ProfessionalLevel\Services\ProfessionalLevelService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
 * @subgroup Уровень профессионализма
 * @authenticated
 */
class ProfessionalLevelController extends Controller
{
    public function __construct(
        private readonly ProfessionalLevelService $professionalLevelService
    )
    {
    }

    /**
     * Получение все уровни профессионализма
     *
     * @responseFile storage/responses/professional-level/pagination.json
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        return new SuccessResponse(
            response: ProfessionalLevelResource::collection($this->professionalLevelService->get()),
            message: 'Список уровней профессионализма'
        );
    }

    /**
     * Создание уровень профессионализма
     *
     * @bodyParam name array required Массив названий.
     * @bodyParam name.ru string required Название на каком-либо языке. Example: Подработка
     * @bodyParam name.en string required Название на каком-либо языке. Example: Подработка
     * @bodyParam name.hy string required Название на каком-либо языке. Example: Подработка
     * @responseFile status=201 storage/responses/professional-level/store.json
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(StoreRequest $request): SuccessResponse
    {
        $condition = $this->professionalLevelService->create($request->toDto());

        return new SuccessResponse(
            response: new ProfessionalLevelResource($condition),
            status: Response::HTTP_CREATED,
            message: 'Уровень профессионализма успешно создана'
        );
    }

    /**
     * Получение определенное уровень профессионализма
     *
     * @urlParam level_id integer ID required Идентификатор уровня. Example: 1
     * @responseFile storage/responses/professional-level/show.json
     * @param ProfessionalLevel $level
     * @return SuccessResponse
     */
    public function show(ProfessionalLevel $level): SuccessResponse
    {
        return new SuccessResponse(
            response: new ProfessionalLevelResource($level),
            message: 'Детали уровня профессионализма'
        );
    }

    /**
     * Обновление условию вакансий
     *
     * @urlParam level_id integer ID required Идентификатор уровня. Example: 1
     * @bodyParam name array required Массив названий.
     * @bodyParam name.ru string required Название на каком-либо языке. Example: Подработка
     * @bodyParam name.en string required Название на каком-либо языке. Example: Подработка
     * @bodyParam name.hy string required Название на каком-либо языке. Example: Подработка
     * @responseFile status=200 storage/responses/professional-level/update.json
     * @param UpdateRequest $request
     * @param ProfessionalLevel $level
     * @return SuccessResponse
     */
    public function update(UpdateRequest $request, ProfessionalLevel $level): SuccessResponse
    {
        $level = $this->professionalLevelService->update($request->toDto(), $level);

        return new SuccessResponse(
            response: new ProfessionalLevelResource($level),
            message: 'Уровень профессионализма успешно обновлена'
        );
    }

    /**
     * Удаление условию вакансий
     *
     * @urlParam level_id integer ID required Идентификатор уровня. Example: 1
     * @responseFile status=200 storage/responses/professional-level/destroy.json
     * @param ProfessionalLevel $level
     * @return SuccessEmptyResponse
     */
    public function destroy(ProfessionalLevel $level): SuccessEmptyResponse
    {
        $this->professionalLevelService->delete($level);

        return new SuccessEmptyResponse(
            message: 'Уровень профессионализма успешно удалена'
        );
    }
}
