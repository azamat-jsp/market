<?php

namespace App\Tbuy\Company\Filters;

use App\Tbuy\Filters\Filter;
use App\Tbuy\Filters\FilterContract;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class IsRejectedFilter extends Filter implements FilterContract
{

    public function handle(array $filters, Builder $query): Builder
    {
        return $query->when(
            value: isset($filters['status']) && $filters['status']->isRejected(),
            callback: fn(EloquentBuilder $builder) => $builder->with(
                relations: 'rejections',
                callback: fn(MorphMany $morphMany) => $morphMany->with('reason')->without('rejectionable')
            )
        );
    }
}
