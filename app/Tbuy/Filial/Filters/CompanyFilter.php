<?php

namespace App\Tbuy\Filial\Filters;

use App\Tbuy\Filters\Filter;
use App\Tbuy\Filters\FilterContract;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class CompanyFilter extends Filter implements FilterContract
{
    public function handle(array $filters, Builder $query): Builder
    {
        return $query->when(isset($filters['company_id']),
            fn(EloquentBuilder $builder) => $builder->where($this->column, $filters['company_id'])
        );
    }
}
