<?php

namespace App\Tbuy\Category\Services;

use App\Tbuy\Attribute\Enums\CacheKey;
use App\Tbuy\Category\DTOs\CategoryAttributeDTO;
use App\Tbuy\Category\DTOs\CategoryDTO;
use App\Tbuy\Category\DTOs\CategoryFilterDTO;
use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CategoryServiceImplementation implements CategoryService
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    )
    {
    }

    public function get(CategoryFilterDTO $dto): Collection
    {
        return $this->categoryRepository->get($dto);
    }

    public function store(CategoryDTO $dto): Category
    {
        return $this->categoryRepository->store($dto);
    }

    public function update(Category $category, CategoryDTO $dto): Category
    {
        return $this->categoryRepository->update($category, $dto);
    }

    public function delete(Category $category): void
    {
        $this->categoryRepository->delete($category);
    }

    public function getChildLevel(Category $category): int
    {
        return $this->categoryRepository->getChildLevel($category);
    }
    public function switchStatus(Category $category, CategoryStatus $status): Category
    {
        return $this->categoryRepository->switchStatus($category, $status);
    }

    public function getAttributes(Category $category, CategoryFilterDTO $payload): LengthAwarePaginator
    {
        $attributes = $this->categoryRepository->attributesByCategory($category);

        return Cache::tags(CacheKey::LIST->value)
            ->remember(
                key: CacheKey::LIST->setKeys($payload),
                ttl: CacheKey::ttl(),
                callback: fn() => $this->categoryRepository->paginate($attributes, $payload->perPage)
            );
    }


    public function syncAttribute(Category $category, CategoryAttributeDTO $dto): bool
    {
        $is_sync = $this->categoryRepository->syncAttributes($category, $dto);

        if ($is_sync) {
            Cache::tags(CacheKey::LIST->value)->clear();
        }

        return $is_sync;
    }

    public function detachAttribute(Category $category, CategoryAttributeDTO $dto): bool
    {
        $is_detached = $this->categoryRepository->detachAttributes($category, $dto);

        if ($is_detached) {
            Cache::tags(CacheKey::LIST->value)->clear();
        }

        return $is_detached;
    }

    public function getLastProducts(Category $category): Collection
    {
        return $this->categoryRepository->products($category);
    }

}
