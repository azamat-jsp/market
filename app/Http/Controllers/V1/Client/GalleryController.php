<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\Model\Gallery;
use App\Tbuy\Gallery\Requests\GalleryFilterRequest;
use App\Tbuy\Gallery\Requests\GalleryStoreRequest;
use App\Tbuy\Gallery\Requests\GalleryUpdateRequest;
use App\Tbuy\Gallery\Resources\GalleryResource;
use App\Tbuy\Gallery\Services\GalleryService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Клиент
 * @subgroup Галерея
 * @authenticated
 */
class GalleryController extends Controller
{
    public function __construct(private readonly GalleryService $galleryService)
    {
    }

    /**
     * Список
     *
     * @queryParam type string Фильтр по типу файла.<br/>
     * <b>photo</b> - изображения <br/>
     * <b>video</b> - видео <br/>
     * Example: photo <br/>
     * @urlParam company_id int required ID компании. Example: 1
     * @responseFile storage/responses/company/gallery/index.json
     * @param GalleryFilterRequest $payload
     * @param Company $company
     * @return SuccessResponse
     */
    public function index(GalleryFilterRequest $payload, Company $company): SuccessResponse
    {
        $galleries = $this->galleryServiceWithCompany($company)->get($payload->toDto());
        return new SuccessResponse(
            response: GalleryResource::collection($galleries),
            message: 'Galleries list'
        );
    }

    /**
     * Новый файл
     *
     * @urlParam company_id int required ID компании. Example: 1
     * @bodyParam photo file required without video Изображение в виде файла jpg,jpeg,png, максимальный размер 2mb
     * @bodyParam video file required without photo Видео файл mp4, максимальный размер 20mb
     * @responseFile status=201 storage/responses/company/gallery/store.json
     * @responseFile status=422 scenario="Validation-failed" storage/responses/company/gallery/validation-failed.json
     * @param GalleryStoreRequest $request
     * @param Company $company
     * @return SuccessResponse
     */
    public function store(GalleryStoreRequest $request, Company $company): SuccessResponse
    {
        $gallery = $this->galleryServiceWithCompany($company)->store($request->toDto());
        return new SuccessResponse(
            response: GalleryResource::make($gallery),
            status: Response::HTTP_CREATED,
            message: 'Gallery created'
        );
    }

    /**
     * Обновление
     *
     * @urlParam company_id int required ID компании. Example: 1
     * @urlParam id int required ID галереи. Example: 1
     * @bodyParam photo file required without video Изображение в виде файла jpg,jpeg,png, максимальный размер 2mb
     * @bodyParam video file required without photo Видео файл mp4, максимальный размер 20mb
     * @responseFile status=201 storage/responses/company/gallery/store.json
     * @responseFile status=422 scenario="Validation-failed" storage/responses/company/gallery/validation-failed.json
     * @param GalleryUpdateRequest $request
     * @param Company $company
     * @param Gallery $gallery
     * @return SuccessResponse
     */
    public function update(GalleryUpdateRequest $request, Company $company, Gallery $gallery): SuccessResponse
    {
        $gallery = $this->galleryServiceWithCompany($company)->update($gallery, $request->toDto());
        return new SuccessResponse(
            response: GalleryResource::make($gallery),
            message: 'Gallery updated'
        );
    }

    /**
     * Удаление
     *
     * @urlParam company_id int required ID компании. Example: 1
     * @urlParam id int required ID галереи. Example: 1
     * @responseFile storage/responses/company/gallery/delete.json
     * @responseFile status=404 scenario="Company ID mismatch with company ID of filial" storage/responses/company/gallery/company-id-mismatch.json
     * @param Company $company
     * @param Gallery $gallery
     * @return SuccessEmptyResponse
     */
    public function destroy(Company $company, Gallery $gallery): SuccessEmptyResponse
    {
        $is_deleted = $this->galleryServiceWithCompany($company)->delete($gallery);
        return new SuccessEmptyResponse(
            message: $is_deleted ? 'Gallery deleted' : 'Gallery not deleted'
        );
    }

    private function galleryServiceWithCompany(Company $company): GalleryService
    {
        return $this->galleryService->setCompany($company);
    }

}
