<?php

namespace App\Tbuy\Search\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read int $model_has_word_type
 * @property-read int $model_has_word_id
 * @property-read int $search_key_word_id
 */
class SearchKeyWordSearchable extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_has_word_id',
        'model_has_word_type',
        'search_key_word_id'
    ];
}
