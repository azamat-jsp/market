<?php

namespace App\Tbuy\Category\Models;

use App\Contracts\SearchableContract;
use App\Contracts\SearchRatingableContract;
use App\Tbuy\Attribute\Models\Attribute;
use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Filters\CategoryAttributesFilter;
use App\Tbuy\Category\Resources\CategoryResource;
use App\Tbuy\Category\SearchRatingCalculations\CalculateActiveProductsCount;
use App\Tbuy\Category\SearchRatingCalculations\CalculateChildLevel;
use App\Tbuy\Company\SearchRatingCalculations\CalculatePurchaseByCategory;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\Product\Models\Product;
use App\Traits\HasAllTranslations;
use App\Traits\SearchableTrait;
use App\Traits\SearchRatingable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\FilterTrait;

/**
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int|null $position
 * @property bool $is_active
 * @property int|null $min_images
 * @property bool $form_description
 * @property bool $offer_services
 * @property string $type
 * @property string|null $description
 * @property-read Media $logo
 * @property-read Media $icon
 * @property-read Category|null $parent
 * @property-read Category|null $grandParent
 * @property-read Collection<Category> $children
 * @property-read Collection<Product> $products
 * @property CategoryStatus $status
 */
class Category extends Model implements SearchRatingableContract, HasMedia, SearchableContract
{
    use HasFactory;
    use HasAllTranslations;
    use SearchRatingable;
    use InteractsWithMedia;
    use SearchableTrait;
    use FilterTrait;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
        'position',
        'is_active',
        'min_images',
        'form_description',
        'offer_services',
        'description',
        'status',
        'type'
    ];

    public array $translatable = [
        'name',
        'description'
    ];

    protected array $filters = [
        CategoryAttributesFilter::class => 'type',
    ];

    protected array $searchRatingCalculations = [
        CalculateActiveProductsCount::class,
        CalculateChildLevel::class,
        CalculatePurchaseByCategory::class
    ];

    /** Relations block */

    /**
     * @relationMorphColumn model
     * @return MorphOne
     */
    public function logo(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', MediaLibraryCollection::CATEGORY_LOGO->value);
    }

    /**
     * @relationMorphColumn model
     * @return MorphOne
     */
    public function icon(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', MediaLibraryCollection::CATEGORY_ICON->value);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function grandParent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id')->with('grandParent');
    }

    /**
     * @relationColumn parent_id
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * @relationColumn category_id
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /** Support block */

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
    }

    public static function getResourceClass(): string
    {
        return CategoryResource::class;
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_categories');
    }
}
