<?php

namespace App\Tbuy\SEO\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $seoable_type
 * @property-read Model|Builder $seoable
 */
class SEO extends Model
{
    protected $table = 'seos';

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'seoable_id',
        'seoable_type'
    ];

    /**
     * @return MorphTo
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
