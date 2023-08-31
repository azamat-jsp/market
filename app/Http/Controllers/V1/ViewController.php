<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\View\Requests\StoreRequest;
use App\Tbuy\View\Services\ViewService;

/**
 * @group Другое
 * @subgroup Просмотры
 */
class ViewController extends Controller
{
    public function __construct(
        private readonly ViewService $viewService
    )
    {
    }

    /**
     * Просмотр вакансии
     *
     * @urlParam  vacancy_id int required ID вакансии Example: 2
     *
     * @header Authorization Bearer 1|c7Yxtgyl4BpcwNOde5mLmUCj06yVSs9mnfrb4Zfs
     *
     * @responseFile status=200 storage/responses/views/vacancy.json
     *
     * @param Vacancy $vacancy
     * @param StoreRequest $request
     * @return SuccessEmptyResponse
     */
    public function vacancies(Vacancy $vacancy, StoreRequest $request): SuccessEmptyResponse
    {
        $this->viewService->view($vacancy, $request->toDto());

        return new SuccessEmptyResponse(
            message: 'Вакансия отмечено как просмотренную'
        );
    }
}
