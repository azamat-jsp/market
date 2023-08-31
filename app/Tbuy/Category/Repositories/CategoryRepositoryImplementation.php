<?php

namespace App\Tbuy\Category\Repositories;

use App\Tbuy\Category\DTOs\CategoryAttributeDTO;
use App\Tbuy\Category\DTOs\CategoryDTO;
use App\Tbuy\Category\DTOs\CategoryFilterDTO;
use App\Tbuy\Category\Enums\CacheKey;
use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryRepositoryImplementation implements CategoryRepository
{
    use HasPaginate;

    public function __construct(
        private readonly MediaLibraryRepository $libraryRepository,
    )
    {
    }

    public function get(CategoryFilterDTO $dto): Collection
    {
        return Cache::tags(CacheKey::TAG_NAME->value)
            ->remember(
                CacheKey::LIST->value,
                CacheKey::ttl(),
                fn() => Category::query()->with(['logo', 'icon', 'attributes'])
                    ->filter($dto->toArray())
                    ->get()
            );
    }

    public function store(CategoryDTO $payload): Category
    {
        return DB::transaction(function () use ($payload) {
            $category = Category::create($payload->toArray());

            if ($payload->logo) {
                $this->libraryRepository->addMedia($category, $payload->logo, MediaLibraryCollection::CATEGORY_LOGO);
            }

            if ($payload->icon) {
                $this->libraryRepository->addMedia($category, $payload->icon, MediaLibraryCollection::CATEGORY_ICON);
            }

            return $category->load(['logo', 'icon']);
        });
    }

    function update(Category $category, CategoryDTO $dto): Category
    {
        return DB::transaction(function () use ($category, $dto) {

            $collectionNameLogo = MediaLibraryCollection::CATEGORY_LOGO;
            $collectionNameIcon = MediaLibraryCollection::CATEGORY_ICON;

            if ($dto->logo) {
                $this->libraryRepository->delete($category, $collectionNameLogo);
                $this->libraryRepository->addMedia($category, $dto->logo, $collectionNameLogo);
            }

            if ($dto->icon) {
                $this->libraryRepository->delete($category, $collectionNameIcon);
                $this->libraryRepository->addMedia($category, $dto->icon, $collectionNameIcon);
            }

            $category->fill($dto->toArray());
            $category->save();

            return $category->load(['logo', 'icon']);
        });
    }

    public function delete(Category $category): void
    {
        $category->logo()->delete();
        $category->icon()->delete();

        $category->delete();
    }

    function getChildLevel(Category $category): int
    {
        $category = $category->loadMissing('grandParent');

        return $this->incrementRatio($category->grandParent, 1);
    }

    private function incrementRatio(?Category $grandParent, int $ratio): int
    {
        if (!$grandParent) {
            return $ratio;
        }

        return $this->incrementRatio($grandParent->grandParent, $ratio + 1);
    }

    public function switchStatus(Category $category, CategoryStatus $status): Category
    {
        $category->status = $status->value;
        $category->save();
        return $category;
    }

    public function attributesByCategory(Category $category): Builder
    {
        $attributes = $category->attributes()->with('values');

        return $attributes->getQuery();
    }

    public function syncAttributes(Category $category, CategoryAttributeDTO $dto): bool
    {
        $category->attributes()->sync($dto->attributes);

        return true;
    }

    public function detachAttributes(Category $category, CategoryAttributeDTO $dto): bool
    {
        return $category->attributes()->detach($dto->attributes);
    }

    public function products(Category $category): Collection
    {
        return $category->products()
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
    }

}
