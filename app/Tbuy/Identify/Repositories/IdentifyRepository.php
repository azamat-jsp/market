<?php

namespace App\Tbuy\Identify\Repositories;

use App\Tbuy\Identify\DTOs\IdentifyDTO;
use Illuminate\Database\Eloquent\Model;

interface IdentifyRepository
{
    public function findByUserId(IdentifyDTO $identifyDTO): ?Model;

    public function findByIpAddress(IdentifyDTO $identifyDTO): ?Model;

    public function store(IdentifyDTO $identifyDTO): Model;
}
