<?php

namespace App\Tbuy\Category\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Category\DTOs\CategoryAttributeDTO;
use App\Tbuy\Category\DTOs\CategoryDTO;
use App\Tbuy\Category\DTOs\CategoryFilterDTO;
use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepository extends PaginatableContract
{
    public function get(CategoryFilterDTO $dto): Collection;

    public function store(CategoryDTO $payload): Category;

    public function update(Category $category, CategoryDTO $dto): Category;

    public function delete(Category $category): void;

    function getChildLevel(Category $category): int;

    public function switchStatus(Category $category, CategoryStatus $status): Category;

    public function paginate(Builder $builder, ?int $perPage = 15): LengthAwarePaginator;

    public function attributesByCategory(Category $category): Builder;

    public function syncAttributes(Category $category, CategoryAttributeDTO $dto): bool;
    public function detachAttributes(Category $category, CategoryAttributeDTO $dto): bool;
    public function products(Category $category): Collection;
}
