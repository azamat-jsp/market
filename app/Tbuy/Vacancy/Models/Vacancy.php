<?php

namespace App\Tbuy\Vacancy\Models;

use App\Contracts\ClickableContract;
use App\Contracts\ViewableContract;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Vacancy\Filters\CategoryFilter;
use App\Traits\FilterTrait;
use App\Traits\HasAllTranslations;
use App\Tbuy\Vacancy\Filters\StatusFilter;
use App\Tbuy\Rejection\Interfaces\Rejectionable;
use App\Tbuy\Rejection\Models\Rejection;
use App\Traits\HasClick;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property string $position
 * @property int $working_conditions
 * @property int $working_type
 * @property VacancyStatus $status
 * @property Carbon $deadline
 * @property Carbon $created_at
 * @property int $salary
 * @property int $company_id
 * @property-read Collection<Media> $images
 * @property-read Category $category
 */
class Vacancy extends Model implements HasMedia, Rejectionable, ViewableContract, ClickableContract
{
    use HasFactory;
    use HasAllTranslations;
    use InteractsWithMedia;
    use SoftDeletes;
    use Favoriteable;
    use HasView;
    use HasClick;
    use FilterTrait;

    public array $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'status',
        'salary',
        'company_id',
        'address',
        'position',
        'working_conditions',
        'working_type',
        'deadline',
    ];

    protected $casts = [
        'status' => VacancyStatus::class
    ];

    protected array $filters = [
        StatusFilter::class => 'status',
        CategoryFilter::class => 'category_id',
    ];

    /**
     * Категория вакансии
     *
     * @relationColumn category_id
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(VacancyCategory::class, 'category_id', 'id');
    }

    /**
     * @relationMorphColumn model
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('collection_name', MediaLibraryCollection::VACANCY_MEDIA->value);
    }

    /**
     * @relationMorphColumn rejectionable
     * @return MorphMany
     */
    public function rejections(): MorphMany
    {
        return $this->morphMany(Rejection::class, 'rejectionable');
    }

    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }
}
