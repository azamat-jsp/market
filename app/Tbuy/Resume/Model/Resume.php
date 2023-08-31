<?php

namespace App\Tbuy\Resume\Model;

use App\Tbuy\Category\Models\Category;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\Resume\DTOs\ResumeFilterDTO;
use App\Tbuy\Vacancy\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read int $id
 * @property int $vacancy_id
 * @property int $category_id
 * @property int $preferred_salary
 * @property string $experience
 * @property Carbon $created_at
 * @property-read Vacancy $vacancy
 */
class Resume extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Favoriteable;


    protected $table = 'resumes';

    protected $fillable = [
        'vacancy_id',
        'preferred_salary', // предпочтительная зарплата
        'experience',// опыт
        'category_id'
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @relationMorphColumn model
     * @return MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', MediaLibraryCollection::RESUME->value);
    }

    /**
     * @param Builder $builder
     * @param ResumeFilterDTO $dto
     * @return void
     */
    public function scopeFilter(Builder $builder, ResumeFilterDTO $dto): void
    {
        $builder->when($dto->category_id, function (Builder $builder) use ($dto) {
            $builder->where('category_id', '=', $dto->category_id);
        });
    }
}
