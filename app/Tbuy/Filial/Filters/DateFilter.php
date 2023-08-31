<?php

namespace App\Tbuy\Filial\Filters;

use App\Tbuy\Filters\Filter;
use App\Tbuy\Filters\FilterContract;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class DateFilter extends Filter implements FilterContract
{

    public function handle(array $filters, Builder $query): Builder
    {
        return $query->when(isset($filters['from']) && isset($filters['to']),
            fn(EloquentBuilder $builder) => $builder->where('created_at', '>=', $filters['from'])
                ->where('created_at', '<=', $filters['to'])
        );
    }
}
