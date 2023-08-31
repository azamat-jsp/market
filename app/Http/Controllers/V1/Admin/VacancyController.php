<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Vacancy\Requests\VacancyToggleStatusRequest;
use App\Tbuy\Vacancy\Requests\VacancyFilterRequest;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\Requests\StoreRequest;
use App\Tbuy\Vacancy\Requests\UpdateRequest;
use App\Tbuy\Vacancy\Resources\VacancyResource;
use App\Tbuy\Vacancy\Services\VacancyService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
 * @subgroup Вакансии
 * @authenticated
 */
class VacancyController extends Controller
{
    public function __construct(
        private readonly VacancyService $vacancyService
    )
    {
    }

    /**
     * Получение всех вакансий
     *
     * @queryParam status string Фильтрация по статусу <br/>
     * <b>active</b> - активный <br/>
     * <b>archived</b> - архив <br/>
     * <b>confirmed</b> - подтверждено <br/>
     * <b>moderation</b> - в модерации <br/>
     * <b>new</b> - новый <br/>
     * <b>pending</b> - в ожидании <br/>
     * <b>rejected</b> - отказано <br/>
     * Example: archived
     * @queryParam perPage int Количество записей на страницу. Example: 15
     * @responseFile storage/responses/vacancy/index.json
     * @param VacancyFilterRequest $request
     * @return SuccessResponse
     */
    public function index(VacancyFilterRequest $request): SuccessResponse
    {
        return new SuccessResponse(
            response: VacancyResource::collection($this->vacancyService->get($request->toDto())),
            message: 'Список вакансий'
        );
    }

    /**
     * Создание вакансии
     *
     * @bodyParam category_id integer ID категории вакансии. Example: 5
     * @bodyParam company_id integer required ID компании. Example: 1
     * @bodyParam title[ru] string required Заголовок на русском языке. Example: Разнорабочий
     * @bodyParam title[en] string required Заголовок на английском языке. Example: Разнорабочий
     * @bodyParam title[hy] string required Заголовок на армянском языке. Example: Разнорабочий
     * @bodyParam description[ru] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam description[en] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam description[hy] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam salary integer Оплата вакансии. Example: 1000
     * @bodyParam images[0][name] string required Название фотографии вакансий. Example:photo-name.jpg
     * @bodyParam images[0][file] file required Файл изображения вакансий
     * @bodyParam address string Рабочий адрес Example: Проспект Мира 18
     * @bodyParam position string Должность. Example: Менеджер
     * @bodyParam working_conditions integer Условия работы. Example: 4
     * @bodyParam working_type integer Тип работы. Example: 2
     * @bodyParam deadline date Крайний срок. Example: 2023-08-17 12:44:23
     * @responseFile status=201 storage/responses/vacancy/store.json
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(StoreRequest $request): SuccessResponse
    {
        $vacancy = $this->vacancyService->create($request->toDto());

        return new SuccessResponse(
            response: new VacancyResource($vacancy),
            status: Response::HTTP_CREATED,
            message: 'Вакансия успешно создана'
        );
    }

    /**
     * Получение определенной вакансии
     *
     * @urlParam id integer ID required Идентификатор вакансии. Example: 1
     * @responseFile storage/responses/vacancy/show.json
     * @param Vacancy $vacancy
     * @return SuccessResponse
     */
    public function show(Vacancy $vacancy): SuccessResponse
    {
        return new SuccessResponse(
            response: new VacancyResource($vacancy->load(['category', 'images'])),
            message: 'Детали вакансии'
        );
    }

    /**
     * Получение избранных вакансий
     *
     * @responseFile storage/responses/vacancy/show.json
     * @param VacancyFilterRequest $request
     * @return SuccessResponse
     */
    public function favoriteVacancies(VacancyFilterRequest $request): SuccessResponse
    {
        $favoriteVacancies = $this->vacancyService->getFavoriteItems($request->toDto());

        return new SuccessResponse(
            response: VacancyResource::collection($favoriteVacancies),
            message: 'Избранные вакансии'
        );
    }

    /**
     * Обновление вакансии
     *
     * @urlParam id integer required ID вакансии. Example: 1
     * @bodyParam category_id integer ID категории вакансии. Example: 5
     * @bodyParam company_id integer required ID компании. Example: 1
     * @bodyParam title[ru] string required Заголовок на русском языке. Example: Разнорабочий
     * @bodyParam title[en] string required Заголовок на английском языке. Example: Разнорабочий
     * @bodyParam title[hy] string required Заголовок на армянском языке. Example: Разнорабочий
     * @bodyParam description[ru] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam description[en] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam description[hy] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam salary integer Оплата вакансии. Example: 1000
     * @bodyParam images[0][name] string required Название фотографии вакансий. Example:photo-name.jpg
     * @bodyParam images[0][file] file required Файл изображения вакансий
     * @bodyParam address string Рабочий адрес Example: Проспект Мира 18
     * @bodyParam position string Должность. Example: Менеджер
     * @bodyParam working_conditions integer Условия работы. Example: 4
     * @bodyParam working_type integer Тип работы. Example: 2
     * @bodyParam deadline date Крайний срок. Example: 2023-08-17 12:44:23
     * @responseFile status=200 storage/responses/vacancy/update.json
     * @param UpdateRequest $request
     * @param Vacancy $vacancy
     * @return SuccessResponse
     */
    public function update(UpdateRequest $request, Vacancy $vacancy): SuccessResponse
    {
        $vacancy = $this->vacancyService->update($request->toDto(), $vacancy);

        return new SuccessResponse(
            response: new VacancyResource($vacancy),
            message: 'Вакансия успешно обновлена'
        );
    }

    /**
     * Удаление вакансии
     *
     * @urlParam id integer ID required Идентификатор вакансии. Example: 1
     * @responseFile status=200 storage/responses/vacancy/destroy.json
     * @param Vacancy $vacancy
     * @return SuccessEmptyResponse
     */
    public function destroy(Vacancy $vacancy): SuccessEmptyResponse
    {
        $this->vacancyService->delete($vacancy);

        return new SuccessEmptyResponse(
            message: 'Вакансия успешно удалена'
        );
    }

    /**
     * Изменение статуса компании
     *
     * @urlParam vacancy_id integer required ID компании. Example: 1
     * @bodyParam status string required Возможные статусы<br/>
     * <b>active</b> - активный <br/>
     * <b>archived</b> - архив <br/>
     * <b>confirmed</b> - подтверждено <br/>
     * <b>moderation</b> - в модерации <br/>
     * <b>new</b> - новый <br/>
     * <b>pending</b> - в ожидании <br/>
     * <b>rejected</b> - отказано <br/>
     * Example: archived
     * @bodyParam reason_id int ID причины отказа, обязательно когда статус - <b>rejected</b>. Example: 3
     * @responseFile storage/responses/vacancy/update-status.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/vacancy/update-status-failed.json
     * @urlParam vacancy integer required ID компании. Example: 1
     * @responseFile status=204 storage/responses/vacancy/toggle-status.json
     * @param VacancyToggleStatusRequest $request
     * @param Vacancy $vacancy
     * @return SuccessEmptyResponse
     */
    public function toggleStatus(VacancyToggleStatusRequest $request, Vacancy $vacancy): SuccessEmptyResponse
    {
        $this->vacancyService->toggleStatus($vacancy, $request->toDto());

        return new SuccessEmptyResponse(
            message: "Статус изменен"
        );
    }
}
