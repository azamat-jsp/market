<?php

namespace App\Tbuy\Gallery\Model;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\Enums\GalleryType;
use App\Tbuy\Gallery\Filters\TypeFilter;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FilterTrait;

    protected $fillable = [
        'type',
        'company_id'
    ];

    protected $casts = [
      'type' => GalleryType::class
    ];

    protected array $filters = [
        TypeFilter::class => 'type',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function photo(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', '=', MediaLibraryCollection::PHOTO);
    }

    public function video(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', '=', MediaLibraryCollection::VIDEO);
    }

}
