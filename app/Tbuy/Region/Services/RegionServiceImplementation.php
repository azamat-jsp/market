<?php

namespace App\Tbuy\Region\Services;

use App\Tbuy\Region\DTOs\RegionDTO;
use App\Tbuy\Region\Models\Region;
use App\Tbuy\Region\Repositories\RegionRepository;
use App\Tbuy\Region\Enums\CacheKey;
use Illuminate\Support\Collection;

class RegionServiceImplementation implements RegionService
{

    public function __construct(
        private readonly RegionRepository $regionRepository)
    {
    }

    public function getWithCache(): Collection
    {
         return cache()->tags(CacheKey::REGION_LIST->value)->remember(CacheKey::REGION_LIST->value, CacheKey::ttl(), function () {
            return Region::with('country')->get();
        });
    }

    public function createAndClearCache(RegionDTO $regionDTO): Region
    {
        $region = $this->regionRepository->create($regionDTO);
        cache()->tags(CacheKey::REGION_LIST->value)->clear();
        return $region;
    }

    public function updateAndClearCache(Region $region, RegionDTO $regionDTO): Region
    {
        $updatedRegion = $this->regionRepository->update($region, $regionDTO);
        cache()->tags(CacheKey::REGION_LIST->value)->clear();
        return $updatedRegion;
    }

    public function delete(Region $region): void
    {
        $this->regionRepository->delete($region);
        cache()->tags(CacheKey::REGION_LIST->value)->clear();
    }
}
