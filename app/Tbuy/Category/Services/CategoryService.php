<?php

namespace App\Tbuy\Category\Services;

use App\Tbuy\Category\DTOs\CategoryAttributeDTO;
use App\Tbuy\Category\DTOs\CategoryDTO;
use App\Tbuy\Category\DTOs\CategoryFilterDTO;
use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryService
{
    public function get(CategoryFilterDTO $dto): Collection;

    public function store(CategoryDTO $dto): Category;

    public function update(Category $category, CategoryDTO $dto): Category;

    public function delete(Category $category): void;

    public function getChildLevel(Category $category): int;

    public function switchStatus(Category $category, CategoryStatus $status): Category;

    public function syncAttribute(Category $category, CategoryAttributeDTO $dto): bool;

    public function detachAttribute(Category $category, CategoryAttributeDTO $dto): bool;

    public function getAttributes(Category $category, CategoryFilterDTO $payload): LengthAwarePaginator;

    public function getLastProducts(Category $category): Collection;
}
