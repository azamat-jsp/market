<?php

namespace App\Tbuy\Community\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Community\DTOs\CommunityDTO;
use App\Tbuy\Community\Models\Community;
use Illuminate\Database\Eloquent\Builder;

interface CommunityRepository extends PaginatableContract
{
    public function index(): Builder;
    public function store(CommunityDTO $payload): Community;
    public function update(Community $community, CommunityDTO $payload): Community;
    public function delete(Community $community): bool;
}
