<?php

namespace App\Tbuy\Click\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UserClick extends Model
{
    use HasFactory;

    protected $fillable = ['clickable_type', 'clickable_id', 'identifier_id'];

    public function clickable(): MorphTo
    {
        return $this->morphTo();
    }
}
