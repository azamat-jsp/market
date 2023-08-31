<?php

namespace App\Tbuy\Banner\Models;

use App\Tbuy\Banner\Filters\BannerFilter;
use App\Tbuy\Banner\Filters\CompanyFilter;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\Target\Models\Target;
use App\Traits\FilterTrait;
use App\Traits\HasAllTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read int $id
 * @property string $name
 * @property array $content
 * @property int $company_id
 * @property int $banner_id
 * @property-read Company $company
 * @property-read Banner $banner
 * @property-read MediaCollection $file
 */
class Banner extends Model  implements HasMedia
{
    use HasFactory;
    use FilterTrait, HasAllTranslations, SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'content',
        'company_id'
    ];

    public array $translatable = [
        'name'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    protected array $filters = [
        CompanyFilter::class => 'company_id',
        BannerFilter::class => 'id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function target(): MorphMany
    {
        return $this->morphMany(Target::class, 'targetable');
    }

    public function file(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('collection_name', '=', MediaLibraryCollection::BANNER_FILE);
    }
}
