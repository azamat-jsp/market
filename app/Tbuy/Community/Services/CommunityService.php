<?php

namespace App\Tbuy\Community\Services;

use App\Tbuy\Community\DTOs\CommunityDTO;
use App\Tbuy\Community\DTOs\CommunityFetchDTO;
use App\Tbuy\Community\Models\Community;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommunityService
{
    public function index(CommunityFetchDTO $payload): LengthAwarePaginator;
    public function store(CommunityDTO $payload): Community;
    public function update(Community $community, CommunityDTO $payload): Community;
    public function delete(Community $community): bool;


}
