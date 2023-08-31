<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Resume\Requests\ResumeFilterRequest;
use App\Tbuy\Resume\Requests\ResumeRequest;
use App\Tbuy\Resume\Resources\ResumeResource;
use App\Tbuy\Resume\Services\ResumeService;
use App\Tbuy\User\Services\Auth\AuthService;
use App\Tbuy\Vacancy\Models\Vacancy;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Клиент
 * @subgroup Резюме
 */
class ResumeController extends Controller
{
    public function __construct(
        private readonly ResumeService $resumeService,
        private readonly AuthService $authRepository,
    )
    {
    }

    /**
     * Создание резюме для вакансии
     *
     * @bodyParam vacancy_id integer required ID вакансии. Example: 1
     * @bodyParam preferred_salary integer required Предпочтительная зарплата. Example: 100
     * @bodyParam experience string required Опыт. Example: 2
     * @param ResumeRequest $request
     * @return SuccessResponse
     */
    public function store(ResumeRequest $request): SuccessResponse
    {
        $resume = $this->resumeService->store($request->toDto());

        return new  SuccessResponse(
            response: ResumeResource::make($resume),
            status: Response::HTTP_CREATED,
            message: 'Резюме создано'
        );
    }

    /**
     * Список
     *
     * @queryParam category_id int Фильтрация по категориям, надо передать ID категории. Example: 2
     * @urlParam company int required ID компании по которой будет возвращаться все резюме этой компании
     * @param ResumeFilterRequest $request
     * @param Company $company
     * @return SuccessResponse
     */
    public function index(ResumeFilterRequest $request, Company $company): SuccessResponse
    {
        $resumes = $this->resumeService->get($request->toDto(), $company);
        return new SuccessResponse(
            response: ResumeResource::collection($resumes),
            message: "Resume list"
        );
    }

    /**
     * Все отклики по этой вакансии
     *
     * @urlParam vacancy integer required ID Вакансии. Example: 1
     * @param Vacancy $vacancy
     * @return SuccessResponse
     */
    public function feedbackOnThisVacancy(Vacancy $vacancy): SuccessResponse
    {
        $feedback = $this->resumeService->feedbackOnThisVacancy($vacancy);

        return new SuccessResponse(
            response: ResumeResource::collection($feedback),
            message: 'Все отклики по этой вакансии'
        );
    }

    /**
     * Добавление резюме в избранное
     *
     * @urlParam resume integer required ID резюме. Example: 1
     * @param Resume $resume
     * @return SuccessResponse
     */
    public function favorite(Resume $resume): SuccessResponse
    {
        $user = $this->authRepository->getAuthUser();
        $user->favorite($resume);

        return new  SuccessResponse(
            response: ResumeResource::make($resume->load('vacancy')),
            status: Response::HTTP_CREATED,
            message: 'Резюме добавлено в избранное'
        );
    }

    /**
     * Избранные вакансии
     *
     * Получение списка избранных вакансий авторизованного пользователя
     *
     * @return SuccessResponse
     */
    public function getFavoriteResumes(): SuccessResponse
    {
        $user = $this->authRepository->getAuthUser();

        $favoriteResumes = $user->getFavoriteItems(Resume::class)->with(['vacancy', 'category', 'file'])->paginate();

        return new SuccessResponse(
            response: ResumeResource::collection($favoriteResumes),
            status: Response::HTTP_OK,
            message: 'Список избранных резюме'
        );
    }
}
