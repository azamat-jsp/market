<?php

namespace App\Tbuy\Region\Models;

use App\Tbuy\Country\Models\Country;
use App\Tbuy\User\Models\User;
use App\Traits\HasAllTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 */
class Region extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAllTranslations;

    protected $fillable = [
        'name',
        'country_id',
        'user_id'
    ];

    public array $translatable = [
        'name',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
