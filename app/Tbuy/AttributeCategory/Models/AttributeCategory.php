<?php

namespace App\Tbuy\AttributeCategory\Models;

use App\Tbuy\Attributable\Models\Attributable;
use App\Tbuy\Attribute\Models\Attribute;
use App\Tbuy\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property int $attribute_id
 * @property int $category_id
 * @property boolean $is_multiple
 * @property boolean $keyword
 * @property boolean $required_for_organization
 * @property boolean $form_name
 * @property boolean $for_seo
 * @property int $position
 */
class AttributeCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'attribute_id',
        'category_id',
        'is_multiple',
        'keyword',
        'required_for_organization',
        'form_name',
        'for_seo',
        'position',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
