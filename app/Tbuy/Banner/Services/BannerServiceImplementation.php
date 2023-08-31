<?php

namespace App\Tbuy\Banner\Services;

use App\Tbuy\Banner\DTOs\BannerDTO;
use App\Tbuy\Banner\Enums\CacheKey;
use App\Tbuy\Banner\Models\Banner;
use App\Tbuy\Banner\Repositories\BannerRepository;
use App\Tbuy\Company\Enums\CacheKeys;
use App\Tbuy\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class BannerServiceImplementation implements BannerService
{
    public function __construct(
        private readonly BannerRepository $bannerRepository
    )
    {
    }

    public function getWithCache(): Collection
    {
        return Cache::tags(CacheKey::BANNER_TAG->value)
            ->remember(
                key: CacheKey::LIST->value,
                ttl: CacheKey::ttl(),
                callback: fn() => $this->bannerRepository->get()
            );
    }

    public function createAndClearCache(BannerDTO $payload): Banner
    {
        $banner = $this->bannerRepository->create($payload);

        Cache::tags(CacheKey::BANNER_TAG->value)->clear();

        return $banner;
    }

    public function updateAndClearCache(Banner $banner, BannerDTO $payload): Banner
    {
        $this->bannerRepository->update($banner, $payload);

        Cache::tags(CacheKey::BANNER_TAG->value)->clear();

        return $banner;
    }

    public function deleteAndClearCache(Banner $banner): bool
    {
        $deleted = $this->bannerRepository->delete($banner);

        Cache::tags(CacheKey::BANNER_TAG->value)->clear();

        return $deleted;
    }

    public function getByCompany(Company $company)
    {
        return Cache::tags(CacheKeys::COMPANY_BANNER_TAG->value)
            ->remember(
                CacheKeys::COMPANY_BANNER->value . '_' . $company->id,
                CacheKeys::ttl(),
                fn() => $this->bannerRepository->getByCompany($company)
            );
    }
}
