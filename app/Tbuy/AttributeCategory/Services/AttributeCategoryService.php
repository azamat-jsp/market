<?php

namespace App\Tbuy\AttributeCategory\Services;

use App\Tbuy\AttributeCategory\DTOs\AttributeCategoryDTO;
use App\Tbuy\AttributeCategory\DTOs\FilterDTO;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use Illuminate\Pagination\LengthAwarePaginator;

interface AttributeCategoryService
{
    public function get(FilterDTO $filter): LengthAwarePaginator;

    public function create(AttributeCategoryDTO $payload): AttributeCategory;

    public function update(AttributeCategory $attributeCategory, AttributeCategoryDTO $payload): AttributeCategory;

    public function delete(AttributeCategory $attributeCategory): void;
}
