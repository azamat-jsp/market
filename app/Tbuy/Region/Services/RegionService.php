<?php

namespace App\Tbuy\Region\Services;

use App\Tbuy\Region\DTOs\RegionDTO;
use App\Tbuy\Region\Models\Region;
use Illuminate\Support\Collection;

interface RegionService
{
    public function getWithCache(): Collection;

    public function createAndClearCache(RegionDTO $regionDTO): Region;

    public function updateAndClearCache(Region $region, RegionDTO $regionDTO): Region;

    public function delete(Region $region): void;
}
