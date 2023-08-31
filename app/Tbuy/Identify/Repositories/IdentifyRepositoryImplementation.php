<?php

namespace App\Tbuy\Identify\Repositories;

use App\Tbuy\Identify\DTOs\IdentifyDTO;
use App\Tbuy\Identify\Models\UserIdentify;
use Illuminate\Database\Eloquent\Model;

class IdentifyRepositoryImplementation implements IdentifyRepository
{
    public function findByUserId(IdentifyDTO $identifyDTO): ?Model
    {
        return UserIdentify::query()->where('user_id', $identifyDTO->user_id)->first();
    }

    public function findByIpAddress(IdentifyDTO $identifyDTO): ?Model
    {
        return UserIdentify::query()
            ->where('ip_address', $identifyDTO->ip_address)
            ->whereNull('user_id')
            ->first();
    }

    public function store(IdentifyDTO $identifyDTO): Model
    {
        return UserIdentify::query()->create($identifyDTO->toArray());
    }
}
