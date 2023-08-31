<?php

namespace App\Tbuy\View\Models;

use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UserView extends Model
{
    use HasFactory;

    protected $fillable = ['viewable_type', 'viewable_id', 'identifier_id'];

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
