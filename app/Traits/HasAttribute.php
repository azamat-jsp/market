<?php

namespace App\Traits;

use App\Tbuy\Attributable\Models\Attributable;

trait HasAttribute
{
    public function attributable()
    {
        return $this->morphMany(Attributable::class, 'attributable');
    }
}
