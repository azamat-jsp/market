<?php

namespace App\Tbuy\Brand\Listeners;

use App\Tbuy\Brand\Enums\CacheKey;
use App\Tbuy\Brand\Events\AttachProduct;
use App\Tbuy\Brand\Repositories\BrandRepository;
use App\Tbuy\Product\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cache;

class AttachProductListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly BrandRepository $brandRepository,
        private readonly ProductRepository $productRepository
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AttachProduct $event): void
    {
        $brand = $this->brandRepository->findById($event->brand_id);
        $this->productRepository->attachToBrand($brand, $event->payload);

        Cache::tags(CacheKey::BRAND_TAG)->clear();
    }
}
