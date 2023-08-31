<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\Requests\Client\StoreRequest;
use App\Tbuy\Vacancy\Resources\VacancyResource;
use App\Tbuy\Vacancy\Services\Client\VacancyService;
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
     * Создание вакансии
     *
     * @bodyParam category_id integer ID категории вакансии. Example: 5
     * @bodyParam title[ru] string required Заголовок на русском языке. Example: Разнорабочий
     * @bodyParam title[en] string required Заголовок на английском языке. Example: Разнорабочий
     * @bodyParam title[hy] string required Заголовок на армянском языке. Example: Разнорабочий
     * @bodyParam description[ru] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam description[en] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam description[hy] string required Описание на каком-либо языка. Example: Разнорабочий на склад
     * @bodyParam salary integer Оплата вакансии. Example: 1000
     * @bodyParam address string Рабочий адрес Example: Проспект Мира 18
     * @bodyParam position string Должность. Example: Менеджер
     * @bodyParam working_conditions integer Условия работы. Example: 4
     * @bodyParam working_type integer Тип работы. Example: 2
     * @bodyParam clicks integer Количество кликов. Example: 2
     * @bodyParam views integer Количество просмотров. Example: 2
     * @bodyParam created_at date дата создание. Example: 21.09.2023
     * @bodyParam deadline date Крайний срок. Example: 2023-08-17 12:44:23
     * @responseFile status=201 storage/responses/vacancy/store.json
     * @param StoreRequest $request
     * @param Company $company
     * @return SuccessResponse
     */
    public function store(StoreRequest $request, Company $company): SuccessResponse
    {
        $vacancy = $this->vacancyService->setCompany($company)->create($request->toDto());

        return new SuccessResponse(
            response: new VacancyResource($vacancy),
            status: Response::HTTP_CREATED,
            message: 'Вакансия успешно создана'
        );
    }
}
