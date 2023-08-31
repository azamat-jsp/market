<?php
namespace App\Tbuy\Product\Services;

use App\Tbuy\Product\DTOs\ProductDTO;
use App\Tbuy\Product\DTOs\ProductStoreDTO;
use App\Tbuy\Product\DTOs\ProductToggleStatusDTO;
use App\Tbuy\Product\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as CollectionAlias;

interface ProductService
{
    public function get(ProductDTO $productDTO, array $with = []): LengthAwarePaginator;

    public function store(ProductStoreDTO $payload): Product;
    public function update(ProductStoreDTO $payload, Product $product): Product;

    public function setAttribute(Product $product, CollectionAlias $collection): Product;

    public function getZeroAmount(ProductDTO $productDTO, array $with = []): LengthAwarePaginator;

    public function toggleStatus(Product $product, ProductToggleStatusDTO $payload): Product;

    public function extendName(Product $product, CollectionAlias $collection): Product;

}
