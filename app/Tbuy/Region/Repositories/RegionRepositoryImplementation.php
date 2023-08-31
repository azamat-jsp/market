<?php

namespace App\Tbuy\Region\Repositories;

use App\Tbuy\Region\DTOs\RegionDTO;
use App\Tbuy\Region\Models\Region;
use App\Tbuy\Region\Enums\CacheKey;
use Illuminate\Support\Collection;

class RegionRepositoryImplementation implements RegionRepository
{
    public function get(): Collection
    {
        return Region::with('country')->get();
    }

    public function create(RegionDTO $regionDTO): Region
    {
        $region = new Region($regionDTO->toArray());
        $region->save();

        return $region;
    }

    public function update(Region $region, RegionDTO $regionDTO): Region
    {
        $region->update($regionDTO->toArray());


        return $region;
    }

    public function delete(Region $region): void
    {
        $region->delete();

    }

}
