<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Category\Requests\CategoryAttributeRequest;
use App\Tbuy\Category\Services\CategoryService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
 * @subgroup Атрибуты Категорий
 * @authenticated
 */
class CategoryAttributeController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    /**
     * Добавление атрибутов для категории
     *
     * @bodyParam attributes.* int required ID атрибутов. Example: 1
     * @urlParam id integer required ID категории. Example: 1
     * @responseFile status=201 storage/responses/category/store.json
     * @param CategoryAttributeRequest $request
     * @param Category $category
     * @return SuccessEmptyResponse
     */
    public function store(CategoryAttributeRequest $request, Category $category): SuccessEmptyResponse
    {
        $this->categoryService->syncAttribute($category, $request->toDto());

        return new SuccessEmptyResponse(
            message: "Category attributes attached",
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Обновление атрибутов для категории
     *
     * @bodyParam attributes.* int required ID атрибутов. Example: 1
     * @urlParam id integer required ID категории. Example: 1
     * @responseFile status=200 storage/responses/category/update.json
     * @param CategoryAttributeRequest $request
     * @param Category $category
     * @return SuccessResponse
     */
    public function update(CategoryAttributeRequest $request, Category $category): SuccessEmptyResponse
    {
        $this->categoryService->syncAttribute($category, $request->toDto());

        return new SuccessEmptyResponse(
            message: "Category attributes attached"
        );
    }

    /**
     * Удаление атрибутов для категории
     *
     * @bodyParam attributes.* int required ID атрибутов. Example: 1
     * @urlParam id integer required ID категории. Example: 1
     * @responseFile status=200 storage/responses/category/destroy.json
     * @param CategoryAttributeRequest $request
     * @param Category $category
     * @return SuccessEmptyResponse
     */
    public function destroy(CategoryAttributeRequest $request, Category $category): SuccessEmptyResponse
    {
       $this->categoryService->detachAttribute($category, $request->toDto());

        return new SuccessEmptyResponse(
            message: "Category attributes deleted"
        );
    }

}
