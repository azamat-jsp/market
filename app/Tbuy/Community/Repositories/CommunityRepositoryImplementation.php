<?php

namespace App\Tbuy\Community\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Community\DTOs\CommunityDTO;
use App\Tbuy\Community\Models\Community;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;

class CommunityRepositoryImplementation implements CommunityRepository
{
    use HasPaginate;

    public function index(): Builder
    {
        return Community::query();
    }
    public function store(CommunityDTO $payload): Community
    {
        $community = new Community();
        $community->setTranslations('name', $payload->name);
        $community->save();
        return $community;
    }
    public function update(Community $community, CommunityDTO $payload): Community
    {
        $community->setTranslations('name', $payload->name);
        $community->save();
        return $community;
    }
    public function delete(Community $community): bool
    {
        return $community->delete();
    }
}
