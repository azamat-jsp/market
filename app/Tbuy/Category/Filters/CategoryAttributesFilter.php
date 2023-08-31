<?php


namespace App\Tbuy\Category\Filters;

use App\Tbuy\Category\Enums\CategoryAttributeType;
use App\Tbuy\Filters\Filter;
use App\Tbuy\Filters\FilterContract;
use Illuminate\Contracts\Database\Query\Builder;

class CategoryAttributesFilter extends Filter implements FilterContract
{
    public function handle(array $filters, Builder $query): Builder
    {
        if (isset($filters['type'])) {
            if ($this->isCategoryType($filters)) {
                $query->where('type', $filters['type'])
                    ->doesntHave('attributes');
            }
            elseif ($this->isFilterType($filters)) {
                $query->where('type', $filters['type'])
                    ->whereHas('attributes');
            }
        }

       return $query;
    }

    private function isCategoryType(array $filters): bool
    {
        return $filters['type'] === CategoryAttributeType::CATEGORY->value;
    }

    private function isFilterType(array $filters): bool
    {
        return $filters['type'] === CategoryAttributeType::FILTERS->value;
    }

}
