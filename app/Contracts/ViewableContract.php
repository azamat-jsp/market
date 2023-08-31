<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ViewableContract
{
    public function views(): MorphMany;
}
