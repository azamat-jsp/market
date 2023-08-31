<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Community\Models\Community;
use App\Tbuy\Community\Requests\CommunityFetchRequest;
use App\Tbuy\Community\Resources\CommunityResource;
use App\Tbuy\Community\Services\CommunityService;

/**
 * @group Клиент
 * @subgroup Сообщества
 * @authenticated
 */
class CommunityController extends Controller
{
    public function __construct(private readonly CommunityService $communityService)
    {
    }

    /**
     * Получение списка сообществ
     *
     * @responseFile storage/responses/community/index.json
     * @param CommunityFetchRequest $request
     * @return SuccessResponse
     */
    public function index(CommunityFetchRequest $request): SuccessResponse
    {
        $category = $this->communityService->index($request->toDto());

        return new SuccessResponse(
            response: CommunityResource::collection($category),
            message: "Community list"
        );
    }

    /**
     * Детальная информация сообщества
     *
     * @urlParam id integer required ID сообщества. Example: 1
     * @responseFile storage/responses/community/show.json
     * @param Community $community
     * @return SuccessResponse
     */
    public function show(Community $community): SuccessResponse
    {
        return new SuccessResponse(
            response: CommunityResource::make($community),
            message: "Community detail"
        );
    }
}
