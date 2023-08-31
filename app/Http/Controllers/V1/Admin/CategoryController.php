<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Category\Requests\CategoryFilterRequest;
use App\Tbuy\Category\Requests\StoreRequest;
use App\Tbuy\Category\Requests\UpdateRequest;
use App\Tbuy\Category\Resources\CategoryResource;
use App\Tbuy\Category\Services\CategoryService;
use App\Tbuy\Product\Resources\ProductResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
 * @subgroup Категории
 * @authenticated
 */
class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    /**
     * Получение списка категорий
     * @bodyParam type string Тип фильтрации. Example: all|category|filters
     * @responseFile storage/responses/category/index.json
     * @param CategoryFilterRequest $request
     * @return SuccessResponse
     */
    public function index(CategoryFilterRequest $request): SuccessResponse
    {
        $category = $this->categoryService->get($request->toDto());

        return new SuccessResponse(
            response: CategoryResource::collection($category),
            message: "Category list"
        );
    }

    /**
     * Получение уровня категории
     *
     * @urlParam category_id int required ID категории. Example: 155
     * @response {"success": true, "message": "Category level", "data":{"ratio": 3}}
     * @param Category $category
     * @return SuccessResponse
     */
    public function getChildLevel(Category $category): SuccessResponse
    {
        $ratio = $this->categoryService->getChildLevel($category);

        return new SuccessResponse(
            response: response([
                'ratio' => $ratio
            ]),
            message: 'Category level'
        );
    }

    /**
     * Изменение статуса категории
     *
     * @urlParam category_id int required ID категории. Example: 155
     * @bodyParam status CategoryStatus required Статус категории. Example: true
     * @response {"success": true, "message": "Category status switched", "data":{"is_enabled": false}}
     * @param Category $category
     * @param CategoryStatus $status
     * @return SuccessResponse
     */
    public function switchStatus(Category $category, CategoryStatus $status): SuccessResponse
    {
        $data = $this->categoryService->switchStatus($category, $status);

        return new SuccessResponse(
            response:CategoryResource::make($data),
            message: 'Category status switched'
        );
    }

    /**
     * Создание категории
     *
     * @bodyParam name[ru] string required Название на русском. Example: Название.
     * @bodyParam name[en] string required Название на английском. Example: Title
     * @bodyParam name[hy] string required Название на армянском. Example: Անվանում
     * @bodyParam slug string required Название категории. Example: phone
     * @bodyParam parent_id integer ID Название категории. Example: 1
     * @bodyParam position integer Позиция. Example: 5
     * @bodyParam is_active boolean Активна ли. Example: true
     * @bodyParam min_images integer Минимальное количество изображений. Example: 3
     * @bodyParam form_description boolean Показывать ли описание формы. Example: true
     * @bodyParam offer_services boolean Предоставляет ли услуги. Example: false
     * @bodyParam description[ru] string required Описание на русском. Example: Описание.
     * @bodyParam description[en] string required Описание на английском. Example: Description
     * @bodyParam description[hy] string required Описание на армянском. Example: Նկարագրություն
     * @bodyParam logo file required Логотип. Пример: изображение.jpg
     * @bodyParam icon file required Иконка. Пример: иконка.png
     * @responseFile status=201 storage/responses/category/store.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/category/validation-failed.json
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(StoreRequest $request): SuccessResponse
    {
        $createCategory = $this->categoryService->store($request->toDto());

        return new SuccessResponse(
            response: CategoryResource::make($createCategory),
            status: Response::HTTP_CREATED,
            message: "Category created"
        );
    }

    /**
     * Детали информация категории
     *
     * @urlParam id integer required ID категории. Example: 1
     * @responseFile storage/responses/category/show.json
     * @param Category $category
     * @return SuccessResponse
     */
    public function show(Category $category): SuccessResponse
    {
        return new SuccessResponse(
            response: CategoryResource::make($category),
            message: "Category detail"
        );
    }

    /**
     * Обновление данных категории
     *
     * @bodyParam name[ru] string required Название на русском. Example: Название.
     * @bodyParam name[en] string required Название на английском. Example: Title
     * @bodyParam name[hy] string required Название на армянском. Example: Անվանում
     * @bodyParam slug string required Название категории. Example: phone
     * @bodyParam parent_id integer ID Название категории. Example: 1
     * @bodyParam position integer Позиция. Example: 5
     * @bodyParam is_active boolean Активна ли. Example: true
     * @bodyParam min_images integer Минимальное количество изображений. Example: 3
     * @bodyParam form_description boolean Показывать ли описание формы. Example: true
     * @bodyParam offer_services boolean Предоставляет ли услуги. Example: false
     * @bodyParam description[ru] string required Описание на русском. Example: Описание.
     * @bodyParam description[en] string required Описание на английском. Example: Description
     * @bodyParam description[hy] string required Описание на армянском. Example: Նկարագրություն
     * @bodyParam logo file required Логотип. Пример: изображение.jpg
     * @bodyParam icon file required Иконка. Пример: иконка.png
     * @responseFile status=201 storage/responses/category/update.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/category/validation-failed.json
     * @param UpdateRequest $request
     * @param Category $category
     * @return SuccessResponse
     */
    public function update(UpdateRequest $request, Category $category): SuccessResponse
    {
        $updateCategory = $this->categoryService->update($category, $request->toDto());

        return new SuccessResponse(
            response: CategoryResource::make($updateCategory),
            message: "Category update"
        );
    }

    /**
     * Удаление категории
     *
     * @urlParam id integer required ID категории. Example: 1
     * @responseFile status=201 storage/responses/category/destroy.json
     * @param Category $category
     * @return SuccessEmptyResponse
     */
    public function destroy(Category $category): SuccessEmptyResponse
    {
        $this->categoryService->delete($category);

        return new SuccessEmptyResponse(
            message: "Category deleted"
        );
    }

    /**
     * Показать послдение продукты данной категории
     *
     * @urlParam id integer required ID категории. Example: 1
     * @responseFile storage/responses/product/show.json
     * @param Category $category
     * @return SuccessResponse
     */
    public function lastProducts(Category $category): SuccessResponse
    {
        $products = $this->categoryService->getLastProducts($category);

        return new SuccessResponse(
            response: ProductResource::collection($products),
            message: "product list"
        );
    }

}
