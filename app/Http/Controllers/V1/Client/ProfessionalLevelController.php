<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\ProfessionalLevel\Resources\ProfessionalLevelResource;
use App\Tbuy\ProfessionalLevel\Services\ProfessionalLevelService;

/**
 * @group Клиент
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
     * @queryParam page int nullable
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
}
