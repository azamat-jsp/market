<?php

namespace App\Tbuy\Region\Repositories;

use App\Tbuy\Region\DTOs\RegionDTO;
use App\Tbuy\Region\Models\Region;
use Illuminate\Support\Collection;

interface RegionRepository
{
    public function get(): Collection;

    public function create(RegionDTO $regionDTO): Region;

    public function update(Region $region, RegionDTO $regionDTO): Region;

    public function delete(Region $region): void;
}
