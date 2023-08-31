<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Tbuy\Region\Models\Region;
use App\Tbuy\Region\Request\StoreRequest;
use App\Tbuy\Region\Request\UpdateRequest;
use App\Tbuy\Region\Resources\RegionResource;
use App\Tbuy\Region\Services\RegionService;
use App\Http\Responses\SuccessResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Клиент
 * @subgroup Регионы
 * @authenticated
 */
class RegionController extends Controller
{
    public function __construct(
        private readonly RegionService  $regionService
    )
    {
    }

    /**
     * Получение списка
     *
     * @responseFile storage/responses/region/index.json
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        $regions = $this->regionService->getWithCache();

        return new SuccessResponse(
            response: RegionResource::collection($regions),
            message: 'Список регионов'
        );
    }

    /**
     * Создание
     *
     * @bodyParam name array required Название региона на разных языках.
     * @bodyParam name.ru string required Название региона на русском языке.
     * @bodyParam name.en string required Название региона на английском языке.
     * @bodyParam name.hy string required Название региона на армянском языке.
     * @bodyParam country_id int required ID страны, к которой относится регион.
     * @responseFile storage/responses/region/store.json
     *
     * @param  StoreRequest  $request
     * @return SuccessResponse
     */

    public function store(StoreRequest $request): SuccessResponse
    {
        $regionDTO = $request->toDto();
        $region = $this->regionService->createAndClearCache($regionDTO);

        return new SuccessResponse(
            response: new RegionResource($region),
            status: Response::HTTP_CREATED,
            message: 'Регион создан'
        );
    }

    /**
     * Обновление
     *
     * @urlParam id int required ID региона. Example: 1
     * @bodyParam name array required Название региона на разных языках.
     * @bodyParam name.ru string required Название региона на русском языке.
     * @bodyParam name.en string required Название региона на английском языке.
     * @bodyParam name.hy string required Название региона на армянском языке.
     * @bodyParam country_id int required ID страны, к которой относится регион.
     * @responseFile storage/responses/region/update.json
     *
     * @param  UpdateRequest  $request
     * @param  Region  $region
     * @return SuccessResponse
     */

    public function update(UpdateRequest $request, Region $region): SuccessResponse
    {
        $regionDTO = $request->toDto();
        $updatedRegion = $this->regionService->updateAndClearCache($region, $regionDTO);

        return new SuccessResponse(
            response: new RegionResource($updatedRegion),
            message: 'Регион обновлён'
        );
    }

    /**
     * Удаление
     *
     * @urlParam id int required ID региона. Example: 1
     * @responseFile storage/responses/region/destroy.json
     * @param  Region  $region
     * @return SuccessEmptyResponse
     */
    public function destroy(Region $region): SuccessEmptyResponse
    {
        $this->regionService->delete($region);

        return new SuccessEmptyResponse(
            message: "Регион удалён"
        );
    }
}
