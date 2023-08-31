<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use App\Tbuy\AttributeCategory\Requests\FilterRequest;
use App\Tbuy\AttributeCategory\Requests\StoreRequest;
use App\Tbuy\AttributeCategory\Requests\UpdateRequest;
use App\Tbuy\AttributeCategory\Resources\AttributeCategoryResource;
use App\Tbuy\AttributeCategory\Services\AttributeCategoryService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
 * @subgroup Атрибуты Категорий
 * @authenticated
 */
class AttributeCategoryController extends Controller
{
    public function __construct(private readonly AttributeCategoryService $attributeCategoryService)
    {
    }

    /**
     * Получение всех атрибутов категорий
     *
     * @responseFile storage/responses/attribute-category/index.json
     * @param FilterRequest $request
     * @return SuccessResponse
     */
    public function index(FilterRequest $request): SuccessResponse
    {
        $attributes = $this->attributeCategoryService->get($request->toDto());

        return new SuccessResponse(
            response: AttributeCategoryResource::collection($attributes),
            message: 'Список атрибутов категории'
        );
    }

    /**
     * Создать атрибут категорий
     *
     * @bodyParam attribute_id int required id атрибута. Example: 1
     * @bodyParam category_id int required id категории. Example: 5
     * @bodyParam is_multiple bool required Возможность присвоения несколько атрибтуов. Example: true
     * @bodyParam keyword bool Example: true
     * @bodyParam required_for_organization bool required Должно быть указано для организации. Example: true
     * @bodyParam form_name bool Example: true
     * @bodyParam for_seo bool Описание для SEO. Example: true
     * @bodyParam position int required Позиция. Example: 3
     * @responseFile status=201 storage/responses/attribute-category/create.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/attribute-category/validation-failed.json
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(StoreRequest $request): SuccessResponse
    {
        $attribute = $this->attributeCategoryService->create($request->toDto());

        return new SuccessResponse(
            response: AttributeCategoryResource::make($attribute),
            status: Response::HTTP_CREATED,
            message: 'Атрибуты категории созданы'
        );
    }

    /**
     *  Изменить атрибут категорий
     *
     * @urlParam id int required ID атрибута категорий. Example: 1
     * @bodyParam attribute_id int required id атрибута. Example: 1
     * @bodyParam category_id int required id категории. Example: 5
     * @bodyParam is_multiple bool required is_multiple. Example: true
     * @bodyParam keyword bool Example: true
     * @bodyParam required_for_organization bool required Должно быть указано для организации. Example: true
     * @bodyParam form_name bool Example: true
     * @bodyParam for_seo bool Описание для SEO. Example: true
     * @bodyParam position int required Позиция. Example: 3
     * @responseFile storage/responses/attribute-category/update.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/attribute-category/validation-failed.json
     * @param UpdateRequest $request
     * @param AttributeCategory $attributeCategory
     * @return SuccessResponse
     */
    public function update(UpdateRequest $request, AttributeCategory $attributeCategory): SuccessResponse
    {
        $attribute = $this->attributeCategoryService->update($attributeCategory, $request->toDto());

        return new SuccessResponse(
            response: AttributeCategoryResource::make($attribute),
            message: 'Атрибуты категории обновлены'
        );
    }

    /**
     * Удалить
     *
     * @urlParam id int required ID атрибута категорий. Example: 1
     * @responseFile storage/responses/attribute-category/delete.json
     * @param AttributeCategory $attributeCategory
     * @return SuccessEmptyResponse
     */
    public function destroy(AttributeCategory $attributeCategory): SuccessEmptyResponse
    {
        $this->attributeCategoryService->delete($attributeCategory);

        return new SuccessEmptyResponse(
            message: "Атрибуты категории удалены"
        );
    }
}
