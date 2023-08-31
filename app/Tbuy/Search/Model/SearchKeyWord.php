<?php

namespace App\Tbuy\Search\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 */
class SearchKeyWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
