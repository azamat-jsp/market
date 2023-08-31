<?php

namespace App\Tbuy\Vacancy\Models;

use App\Traits\HasAllTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property string $name
 */
class VacancyCategory extends Model
{
    use HasFactory, HasAllTranslations, SoftDeletes;

    public array $translatable = [
        'name'
    ];

    protected $fillable = [
        'name'
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class, 'category_id');
    }
}
