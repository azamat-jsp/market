<?php

namespace App\Tbuy\Product\SearchRatingCalculations;

use App\Contracts\SearchRatingCalculationContract;
use App\Tbuy\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CalculateFavouriteProductsOfPeople implements SearchRatingCalculationContract
{
    public function calculate(Model $model): float|int
    {
        /** @var Product $model */
        return $model->favoriters()->count() * 5;
    }
}
