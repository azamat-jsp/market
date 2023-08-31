<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Tbuy\Click\Services\ClickService;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\View\Requests\StoreRequest;

/**
 * @group Другое
 * @subgroup Клики
 */
class ClickController extends Controller
{
    public function __construct(
        private readonly ClickService $clickService
    )
    {
    }

    /**
     * Клики вакансии
     *
     * @urlParam  vacancy_id int required ID вакансии Example: 2
     *
     * @header Authorization Bearer 1|c7Yxtgyl4BpcwNOde5mLmUCj06yVSs9mnfrb4Zfs
     *
     * @responseFile status=200 storage/responses/clicks/vacancy.json
     *
     * @param Vacancy $vacancy
     * @param StoreRequest $request
     * @return SuccessEmptyResponse
     */
    public function vacancies(Vacancy $vacancy, StoreRequest $request): SuccessEmptyResponse
    {
        $this->clickService->click($vacancy, $request->toDto());

        return new SuccessEmptyResponse(
            message: 'Вакансия отмечено как кликаный'
        );
    }
}
