<?php

namespace App\Tbuy\Brand\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Brand\DTOs\BrandCategoryDTO;
use App\Tbuy\Brand\DTOs\BrandDTO;
use App\Tbuy\Brand\DTOs\BrandFetchDTO;
use App\Tbuy\Brand\DTOs\BrandStatusDTO;
use App\Tbuy\Brand\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Builder;

interface BrandRepository extends PaginatableContract
{
    public function get(BrandFetchDTO $parameters): Builder;

    /**
     * @param int $brand_id
     * @return Brand
     * @throws ModelNotFoundException<Model>
     */
    public function findById(int $brand_id): Brand;

    public function create(BrandDTO $payload): Brand;

    public function update(Brand $brand, BrandDTO $payload);

    public function delete(Brand $brand): bool;

    public function changeStatus(Brand $brand, BrandStatusDTO $payload): Brand;

    public function setCategory(Brand $brand, BrandCategoryDTO $payload): Brand;

}
