<?php

namespace App\Tbuy\Vacancy\Filters;

use App\Tbuy\Filters\Filter;
use App\Tbuy\Filters\FilterContract;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class StatusFilter extends Filter implements FilterContract
{
    public function handle(array $filters, Builder $query): Builder
    {
        return $query->when(isset($filters['status']),
            fn(EloquentBuilder $builder) => $builder->where($this->column, $filters['status'])
        );
    }
}
