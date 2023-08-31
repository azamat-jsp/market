<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Resume\Requests\GuestResumeRequest;
use App\Tbuy\Resume\Resources\ResumeResource;
use App\Tbuy\Resume\Services\ResumeService;
use Symfony\Component\HttpFoundation\Response;

class GuestResumeController extends Controller
{
    public function __construct(
        private readonly ResumeService $resumeService
    )
    {
    }

    /**
     * Создание резюме для не авторизированного пользователя
     *
     * @bodyParam vacancy_id integer required ID вакансии. Example: 1
     * @bodyParam category integer required ID категории. Example: 1
     * @bodyParam preferred_salary integer required Предпочтительная зарплата. Example: 100
     * @bodyParam experience int required Опыт. Example: 2
     * @param GuestResumeRequest $request
     * @return SuccessResponse
     */
    public function store(GuestResumeRequest $request): SuccessResponse
    {
        $resume = $this->resumeService->guestStore($request->toDto());

        return new  SuccessResponse(
            response: ResumeResource::make($resume),
            status: Response::HTTP_CREATED,
            message: 'Резюме создано'
        );
    }
}
