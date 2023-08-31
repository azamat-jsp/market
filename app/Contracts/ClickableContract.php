<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ClickableContract
{
    public function clicks(): MorphMany;
}
