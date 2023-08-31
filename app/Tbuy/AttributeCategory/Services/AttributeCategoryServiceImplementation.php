<?php

namespace App\Tbuy\AttributeCategory\Services;

use App\Tbuy\AttributeCategory\DTOs\AttributeCategoryDTO;
use App\Tbuy\AttributeCategory\DTOs\FilterDTO;
use App\Tbuy\AttributeCategory\Enums\CacheKey;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use App\Tbuy\AttributeCategory\Repositories\AttributeCategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class AttributeCategoryServiceImplementation implements AttributeCategoryService
{
    public function __construct(private readonly AttributeCategoryRepository $attributeCategoryRepository)
    {
    }

    public function get(FilterDTO $filter): LengthAwarePaginator
    {
        return Cache::tags(CacheKey::TAG_NAME->value)
            ->remember(
                CacheKey::LIST->setKeys($filter),
                CacheKey::ttl(),
                fn() => $this->attributeCategoryRepository->paginate(
                    builder: $this->attributeCategoryRepository->get(),
                    perPage: $filter->perPage
                )
            );
    }

    public function create(AttributeCategoryDTO $payload): AttributeCategory
    {
        $attribute = $this->attributeCategoryRepository->create($payload);

        Cache::tags(CacheKey::TAG_NAME->value)->clear();

        return $attribute;
    }

    public function update(AttributeCategory $attributeCategory, AttributeCategoryDTO $payload): AttributeCategory
    {
        $attribute = $this->attributeCategoryRepository->update($attributeCategory, $payload);

        Cache::tags(CacheKey::TAG_NAME->value)->clear();

        return $attribute;
    }

    public function delete(AttributeCategory $attributeCategory): void
    {
        $this->attributeCategoryRepository->delete($attributeCategory);

        Cache::tags(CacheKey::TAG_NAME->value)->clear();
    }
}
