<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Community\Models\Community;
use App\Tbuy\Community\Requests\CommunityFetchRequest;
use App\Tbuy\Community\Requests\CommunityRequest;
use App\Tbuy\Community\Resources\CommunityResource;
use App\Tbuy\Community\Services\CommunityService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
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
     * Создание сообщества
     *
     * @bodyParam name[ru] string required Название на русском. Example: Название.
     * @bodyParam name[en] string required Название на английском. Example: Title
     * @bodyParam name[hy] string required Название на армянском. Example: Անվանում
     * @responseFile storage/responses/community/store.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/community/validation-failed.json
     * @param CommunityRequest $request
     * @return SuccessResponse
     */
    public function store(CommunityRequest $request): SuccessResponse
    {
        $community = $this->communityService->store($request->toDto());

        return new SuccessResponse(
            response: CommunityResource::make($community),
            status: Response::HTTP_CREATED,
            message: "Community created"
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

    /**
     * Обновление данных сообщества
     *
     * @bodyParam name[ru] string required Название на русском. Example: Название.
     * @bodyParam name[en] string required Название на английском. Example: Title
     * @bodyParam name[hy] string required Название на армянском. Example: Անվանում
     * @responseFile status=201 storage/responses/community/update.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/community/validation-failed.json
     * @param CommunityRequest $request
     * @param Community $community
     * @return SuccessResponse
     */
    public function update(CommunityRequest $request, Community $community): SuccessResponse
    {
        $updateCategory = $this->communityService->update($community, $request->toDto());

        return new SuccessResponse(
            response: CommunityResource::make($updateCategory),
            message: "Community update"
        );
    }

    /**
     * Удаление сообщества
     *
     * @urlParam id integer required ID сообщества. Example: 1
     * @responseFile status=201 storage/responses/community/destroy.json
     * @param Community $community
     * @return SuccessEmptyResponse
     */
    public function destroy(Community $community): SuccessEmptyResponse
    {
        $this->communityService->delete($community);

        return new SuccessEmptyResponse(
            message: "Community deleted"
        );
    }

}
