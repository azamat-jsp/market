<?php

namespace App\Tbuy\AttributeCategory\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\AttributeCategory\DTOs\AttributeCategoryDTO;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use Illuminate\Database\Eloquent\Builder;

interface AttributeCategoryRepository extends PaginatableContract
{
    public function get(): Builder;

    public function create(AttributeCategoryDTO $payload): AttributeCategory;

    public function update(AttributeCategory $attributeCategory, AttributeCategoryDTO $payload): AttributeCategory;

    public function delete(AttributeCategory $attributeCategory): bool;
}
