<?php

namespace App\Tbuy\Product\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Brand\DTOs\BrandAttachProductDTO;
use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Product\DTOs\ProductDTO;
use App\Tbuy\Product\DTOs\ProductStoreDTO;
use App\Tbuy\Product\DTOs\ProductToggleStatusDTO;
use App\Tbuy\Product\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface ProductRepository extends PaginatableContract
{
    public function get(ProductDTO $productDTO, array $with = []): Builder;

    public function paginate(Builder $builder, ?int $perPage = 15): LengthAwarePaginator;

    public function store(ProductStoreDTO $dto): Product;
    public function update(ProductStoreDTO $productStoreDTO, Product $product): Product;

    public function toggleStatus(ProductToggleStatusDTO $productToggleStatusDTO, Product $product): Product;

    public function getZeroAmount(ProductDTO $productDTO, array $with = []): Builder;

    public function attachToBrand(Brand $brand, BrandAttachProductDTO $payload): void;
}
