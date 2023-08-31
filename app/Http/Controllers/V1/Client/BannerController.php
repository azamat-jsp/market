<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Banner\Models\Banner;
use App\Tbuy\Banner\Requests\Company\StoreRequest;
use App\Tbuy\Banner\Requests\Company\UpdateRequest;
use App\Tbuy\Banner\Resources\BannerResource;
use App\Tbuy\Banner\Services\BannerService;
use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Company\Models\Company;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @group Клиент
 * @subgroup Баннер
 * @authenticated
 */
class BannerController extends Controller
{
    public function __construct(private readonly BannerService $bannerService)
    {
    }

    /**
     * Список баннеров компании
     *
     * @urlParam company_id int required. Example: 2
     * @responseFile storage/responses/banner/index.json
     *
     * @param Company $company
     * @return SuccessResponse
     */
    public function index(Company $company): SuccessResponse
    {
        $banners = $this->bannerService->getByCompany($company);

        return new SuccessResponse(
            response: BannerResource::collection($banners),
            message: 'banner list'
        );
    }

    /**
     * Новый баннер
     *
     * @urlParam company_id int required. Example: 2
     *
     * @bodyParam name object required
     * @bodyParam name.ru string required Название баннера на русском. Example: баннер
     * @bodyParam name.en string required Название баннера на английском. Example: banner
     * @bodyParam name.hy string required Название баннера на армянском. Example: banner-hy
     * @bodyParam content object required Контент
     * @bodyParam content.ru string required Контент баннера на русском. Example: Контент
     * @bodyParam content.en string required Контент баннера на английском. Example: Контент
     * @bodyParam content.hy string required Контент баннера на армянском. Example: Контент-hy
     * @bodyParam file required PSD файл который будет возвращаться максимальный размер 50мб
     * @responseFile status=201 storage/responses/banner/create.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/banner/validation-failed.json
     *
     * @param Company $company
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(Company $company, StoreRequest $request): SuccessResponse
    {
        $banner = $this->bannerService->createAndClearCache($request->validated());

        return new SuccessResponse(
            response: BannerResource::make($banner),
            status: Response::HTTP_CREATED,
            message: 'Banner created'
        );
    }

    /**
     * Детальная информация о баннере
     *
     * @urlParam company_id int required. Example: 2
     * @urlParam id int required. Example: 31
     *
     * @responseFile storage/responses/banner/show.json
     */
    public function show(Company $company, Banner $banner): Responsable
    {
        $this->checkCompanyAndBrand($company, $banner);

        return new SuccessResponse(
            response: BannerResource::make($banner),
            message: 'Banner detail'
        );
    }

    /**
     * Изменить баннер
     *
     * @urlParam company_id int required. Example: 2
     * @urlParam id int required. Example: 31
     *
     * @bodyParam name object required
     * @bodyParam name.ru string required Название баннера на русском. Example: баннер
     * @bodyParam name.en string required Название баннера на английском. Example: banner
     * @bodyParam name.hy string required Название баннера на армянском. Example: banner-hy
     * @bodyParam content object required Контент
     * @bodyParam content.ru string required Контент баннера на русском. Example: Контент
     * @bodyParam content.en string required Контент баннера на английском. Example: Контент
     * @bodyParam content.hy string required Контент баннера на армянском. Example: Контент-hy
     * @bodyParam file required PSD файл который будет возвращаться максимальный размер 50мб
     * @responseFile status=201 storage/responses/banner/update.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/banner/validation-failed.json
     */
    public function update(Company $company, Banner $banner, UpdateRequest $request): Responsable
    {
        $this->checkCompanyAndBrand($company, $banner);

        $banner = $this->bannerService->updateAndClearCache($banner, $request->toDto());

        return new SuccessResponse(
            response: BannerResource::make($banner),
            message: 'Banner updated'
        );
    }

    /**
     * Удалить баннер
     *
     * @urlParam company_id int required. Example: 2
     * @urlParam id int required. Example: 31
     *
     * @param Company $company
     * @param Banner $banner
     * @return SuccessEmptyResponse
     */
    public function destroy(Company $company, Banner $banner): SuccessEmptyResponse
    {
        $this->checkCompanyAndBrand($company, $banner);

        $this->bannerService->deleteAndClearCache($banner);

        return new SuccessEmptyResponse(
            message: "banner deleted"
        );
    }

    private function checkCompanyAndBrand(Company $company, Banner $banner) {
        if ($banner->company_id != $company->id) {
            throw new NotFoundHttpException();
        }
    }
}
