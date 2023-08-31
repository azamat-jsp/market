<?php

namespace App\Tbuy\Product\Services;

use App\Tbuy\Attributable\Services\AttributableService;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Tbuy\MediaLibrary\Services\MediaLibraryService;
use App\Tbuy\Product\DTOs\ProductDTO;
use App\Tbuy\Product\DTOs\ProductStoreDTO;
use App\Tbuy\Product\DTOs\ProductToggleStatusDTO;
use App\Tbuy\Product\Enums\ProductCacheKey;
use App\Tbuy\Product\Models\Product;
use App\Tbuy\Product\Repositories\ProductRepository;
use App\Tbuy\Rejection\Repository\RejectionRepository;
use App\Tbuy\Visible\Repositories\VisibleRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as CollectionAlias;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductServiceImplementation implements ProductService
{
    public function __construct(
        protected readonly AttributableService    $attributableService,
        protected readonly ProductRepository      $productRepository,
        protected readonly MediaLibraryRepository $mediaLibraryRepository,
        protected readonly MediaLibraryService    $mediaLibraryService,
        protected readonly RejectionRepository    $rejectionRepository,
        protected readonly VisibleRepository      $visibleRepository
    )
    {
    }

    public function get(ProductDTO $productDTO, array $with = []): LengthAwarePaginator
    {
        $query = $this->productRepository->get($productDTO, $with);

        return Cache::tags(ProductCacheKey::LIST->value)
            ->remember(
                key: ProductCacheKey::LIST->withProductDtoKeys($productDTO),
                ttl: ProductCacheKey::ttl(),
                callback: fn() => $this->productRepository->paginate($query, $productDTO->perPage)
            );
    }

    public function store(ProductStoreDTO $payload): Product
    {
        $product = DB::transaction(function () use ($payload) {
            $product = $this->productRepository->store($payload);

            if ($payload->images) {
                $this->mediaLibraryService->addAllMedia($product, $payload->images, MediaLibraryCollection::PRODUCT_MEDIA);
            }

            $product = $this->visibleRepository->create($product, $payload->visible_fields);

            return $this->loadRelations($product);
        });

        Cache::tags(ProductCacheKey::LIST->value)->clear();

        return $product;
    }

    public function update(ProductStoreDTO $payload, Product $product): Product
    {
        $product = DB::transaction(function () use ($product, $payload) {
            $product = $this->productRepository->update($payload, $product);

            if ($payload->images) {
                $this->mediaLibraryService->deleteFileSelectively($product, $payload->images, MediaLibraryCollection::PRODUCT_MEDIA);
            }

            $product = $this->visibleRepository->create($product, $payload->visible_fields);

            return $this->loadRelations($product);
        });

        Cache::tags(ProductCacheKey::LIST->value)->clear();

        return $product;
    }

    public function toggleStatus(Product $product, ProductToggleStatusDTO $payload): Product
    {
        $product = DB::transaction(function () use ($payload, $product) {
            $product = $this->productRepository->toggleStatus($payload, $product);

            if ($product->status->isRejected()) {
                $this->rejectionRepository->create($product, $payload, auth()->id());
            }

            return $this->loadRelations($product);
        });

        Cache::tags(ProductCacheKey::LIST->value)->clear();

        return $product;
    }

    public function setAttribute(Product $product, CollectionAlias $collection): Product
    {
        /** @var Product $product */
        $product = $this->attributableService->prepareAndCreate($product, $collection);

        Cache::tags(ProductCacheKey::LIST->value)->clear();

        return $this->loadRelations($product);
    }

    public function getZeroAmount(ProductDTO $productDTO, array $with = []): LengthAwarePaginator
    {
        $query = $this->productRepository->getZeroAmount($productDTO, $with);

        return Cache::tags(ProductCacheKey::ZERO_LIST->value)
            ->remember(
                key: ProductCacheKey::ZERO_LIST->setKeys($productDTO),
                ttl: ProductCacheKey::ttl(),
                callback: fn() => $this->productRepository->paginate($query, $productDTO->perPage)
            );
    }

    public function extendName(Product $product, CollectionAlias $collection): Product
    {
        /** @var Product $product */
        $product = $this->attributableService->prepareAndSetIsNameTrue($product, $collection);

        Cache::tags(ProductCacheKey::LIST->value)->clear();

        return $this->loadRelations($product);
    }

    public function getProductViews(Product $product): int
    {
        return $product->views;
    }

    private function loadRelations(Product $product): Product
    {
        return $product->load(['brand.company', 'images', 'category', 'attributesList', 'rejections']);
    }
}
