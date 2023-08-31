<?php

namespace App\Tbuy\Community\Models;

use App\Traits\HasAllTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property array $name
 */
class Community extends Model
{
    use HasFactory, HasAllTranslations;

    public array $translatable = ['name'];

    protected $fillable = ['name'];
}
