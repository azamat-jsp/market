<?php

namespace App\Traits;

use App\Tbuy\SEO\Model\SEO;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * HasSEO Trait
 *
 * Добавляет функциональность SEO к моделям, которые её используют.
 */
trait HasSEO
{
    /**
     * @return MorphOne
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SEO::class, 'seoable');
    }
}
