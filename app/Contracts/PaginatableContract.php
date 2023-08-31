<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface PaginatableContract
{
    public function paginate(Builder $builder, ?int $perPage = 15): LengthAwarePaginator;
}
