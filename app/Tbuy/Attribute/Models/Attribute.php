<?php

namespace App\Tbuy\Attribute\Models;

use App\Tbuy\Attribute\Enums\AttributeType;
use App\Tbuy\AttributeValue\Models\AttributeValue;
use App\Traits\HasAllTranslations;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property-read string $for_seo
 * @property-read string $form_name
 * @property-read string keyword
 * @property-read bool $is_multiple
 * @property-read int $position
 * @property AttributeType $name
 * @property string $type
 * @property int $content_count
 * @property-read Collection<int, AttributeValue> $values
 */
class Attribute extends Model
{
    use HasFactory, HasAllTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'content_count'
    ];

    protected $casts = [
        'type' => AttributeType::class,
    ];

    public array $translatable = ['name'];

    /**
     * @relationColumn attribute_id
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }
}
