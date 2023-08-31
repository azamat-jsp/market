<?php

namespace App\Tbuy\Product\Repositories;

use App\Tbuy\Brand\DTOs\BrandAttachProductDTO;
use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Product\DTOs\ProductDTO;
use App\Tbuy\Product\DTOs\ProductStoreDTO;
use App\Tbuy\Product\DTOs\ProductToggleStatusDTO;
use App\Tbuy\Product\Enums\ProductStatus;
use App\Tbuy\Product\Models\Product;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;

class ProductRepositoryImplementation implements ProductRepository
{
    use HasPaginate;

    public function store(ProductStoreDTO $dto): Product
    {
        $product = new Product($dto->toArray());
        $product->setTranslations('name', $dto->name);
        $product->save();

        return $product->load(['category', 'brand.company', 'images']);
    }
    public function update(ProductStoreDTO $productStoreDTO, Product $product): Product
    {
        $product->update(array_filter((array)$productStoreDTO) + ['status' => ProductStatus::WAITING]);

        return $product->load(['category', 'brand.company', 'images']);
    }

    public function toggleStatus(ProductToggleStatusDTO $productToggleStatusDTO, Product $product): Product
    {
        $product->fill([
            'status' => $productToggleStatusDTO->status
        ]);

        if ($productToggleStatusDTO->status === ProductStatus::CONFIRMED) {
            $product->fill([
                'accepted_at' => now()
            ]);
        }

        $product->save();

        return $product->load(['category', 'brand.company', 'images']);
    }

    public function getZeroAmount(ProductDTO $productDTO, array $with = []): Builder
    {
        return Product::query()
            ->with($with)
            ->zeroAmount()
            ->filter($productDTO);
    }

    public function attachToBrand(Brand $brand, BrandAttachProductDTO $payload): void
    {
        Product::query()->whereIn('id', $payload->product)->update([
            'brand_id' => $brand->id,
        ]);
    }

    public function get(ProductDTO $productDTO, array $with = []): Builder
    {
        $product = Product::query()
            ->with($with)
            ->filter($productDTO);

        if ($productDTO->zero_amount) {
            $product = $product->zeroAmount();
        }

        return $product;
    }
}
