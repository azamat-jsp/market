<?php

namespace App\Tbuy\AttributeCategory\Repositories;

use App\Tbuy\AttributeCategory\DTOs\AttributeCategoryDTO;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;

class AttributeCategoryRepositoryImplementation implements AttributeCategoryRepository
{
    use HasPaginate;

    public function get(): Builder
    {
        return AttributeCategory::query()->with(['attribute', 'category']);
    }

    public function create(AttributeCategoryDTO $payload): AttributeCategory
    {
        $attribute = new AttributeCategory($payload->toArray());
        $attribute->save();

        return $attribute;
    }

    public function update(AttributeCategory $attributeCategory, AttributeCategoryDTO $payload): AttributeCategory
    {
        $attributeCategory->fill(array_filter($payload->toArray()));
        $attributeCategory->save();

        return $attributeCategory;
    }

    public function delete(AttributeCategory $attributeCategory): bool
    {
        return $attributeCategory->delete();
    }
}
