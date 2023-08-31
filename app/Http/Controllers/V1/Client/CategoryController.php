<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Category\Requests\CategoryFilterRequest;
use App\Tbuy\Category\Resources\CategoryAttributeResource;
use App\Tbuy\Category\Services\CategoryService;

/**
 * @group Клиент
 * @subgroup Значения атрибутов в Категориях
 * @authenticated
 */
class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService    $categoryService,
    )
    {
    }

    /**
     * Получение списка атрибутов
     *
     * @urlParam category_id int required Example: 1
     * @queryParam page int nullable Example: 1
     * @queryParam perPage int nullable Example: 1
     * @responseFile storage/responses/attribute/index.json
     * @param Category $category
     * @param CategoryFilterRequest $request
     * @return SuccessResponse
     */
    public function attributes(Category $category, CategoryFilterRequest $request): SuccessResponse
    {
        $attributes = $this->categoryService->getAttributes($category, $request->toDto());

        return new SuccessResponse(
            response: CategoryAttributeResource::collection($attributes),
            message: 'Attribute list'
        );
    }
}
