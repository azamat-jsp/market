<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

trait HasPaginate
{
    public function paginate(Builder $builder, ?int $perPage = 15): LengthAwarePaginator
    {
        return $builder->paginate($perPage);
    }
}
