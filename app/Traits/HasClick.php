<?php

namespace App\Traits;

use App\Tbuy\Click\Models\UserClick;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasClick
{
    public function clicks(): MorphMany
    {
        return $this->morphMany(UserClick::class, 'clickable');
    }
}
