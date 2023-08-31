<?php

namespace App\Traits;

use App\Tbuy\View\Models\UserView;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasView
{
    public function views(): MorphMany
    {
        return $this->morphMany(UserView::class, 'viewable');
    }
}
