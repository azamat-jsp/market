<?php

namespace App\Tbuy\Community\Services;

use App\Tbuy\Community\DTOs\CommunityDTO;
use App\Tbuy\Community\DTOs\CommunityFetchDTO;
use App\Tbuy\Community\Enums\CacheKey;
use App\Tbuy\Community\Models\Community;
use App\Tbuy\Community\Repositories\CommunityRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class CommunityServiceImplementation implements CommunityService
{
    public function __construct(private readonly CommunityRepository $repository)
    {
    }
    public function index(CommunityFetchDTO $payload): LengthAwarePaginator
    {
        return Cache::tags(CacheKey::COMMUNITY_LIST->value)
            ->remember(CacheKey::COMMUNITY_LIST->setKeys($payload), CacheKey::ttl(), function () use ($payload) {
                return $this->repository->paginate($this->repository->index(), $payload->per_page);
            });
    }
    public function store(CommunityDTO $payload): Community
    {
        $community =  $this->repository->store($payload);
        Cache::tags(CacheKey::COMMUNITY_TAG->value)->clear();

        return $community;
    }
    public function update(Community $community, CommunityDTO $payload): Community
    {
        $community = $this->repository->update($community, $payload);
        Cache::tags(CacheKey::COMMUNITY_TAG->value)->clear();

        return $community;
    }
    public function delete(Community $community): bool
    {
        $result = $this->repository->delete($community);
        Cache::tags(CacheKey::COMMUNITY_TAG->value)->clear();

        return $result;
    }
}
