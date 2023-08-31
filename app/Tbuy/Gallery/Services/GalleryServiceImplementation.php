<?php

namespace App\Tbuy\Gallery\Services;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\DTOs\GalleryDTO;
use App\Tbuy\Gallery\DTOs\GalleryFilterDTO;
use App\Tbuy\Gallery\Enums\CacheKey;
use App\Tbuy\Gallery\Enums\GalleryType;
use App\Tbuy\Gallery\Model\Gallery;
use App\Tbuy\Gallery\Repositories\GalleryRepository;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

class GalleryServiceImplementation implements GalleryService
{
    private ?Company $company;

    public function __construct(
        private readonly GalleryRepository      $galleryRepository,
        private readonly MediaLibraryRepository $libraryRepository,
    )
    {
    }

    public function setCompany(Company $company): static
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @throws Throwable
     */
    public function get(GalleryFilterDTO $payload): Collection
    {
        throw_if(
            is_null($this->company),
            ModelNotFoundException::class,
            'Company not found'
        );
        $company = $this->company?->id;

        return Cache::tags(CacheKey::GALLERY_TAG->value)->remember(
            CacheKey::LIST->setKeys($payload->toArray() + ['id' => $company]),
            CacheKey::ttl(),
            fn() => $this->galleryRepositoryWithCompany()->get($payload)
        );
    }

    /**
     * @throws Throwable
     */
    public function store(GalleryDTO $payload): Gallery
    {
        throw_if(
            is_null($this->company),
            ModelNotFoundException::class,
            'Company not found'
        );

        $gallery = DB::transaction(function () use ($payload) {
            $gallery = $this->galleryRepositoryWithCompany()->store($payload);
            $this->libraryRepository->addMedia(
                $gallery,
                $payload->{$gallery->type->value},
                $gallery->type == GalleryType::PHOTO ? MediaLibraryCollection::PHOTO : MediaLibraryCollection::VIDEO
            );
            return $gallery;
        });

        Cache::tags(CacheKey::GALLERY_TAG->value)->clear();
        return $gallery;
    }

    /**
     * @param Gallery $gallery
     * @param GalleryDTO $payload
     * @return Gallery
     * @throws Throwable
     */
    public function update(Gallery $gallery, GalleryDTO $payload): Gallery
    {
        throw_if(
            is_null($this->company) || $this->company->id !== $gallery->company_id,
            ModelNotFoundException::class,
            'Company not found'
        );

        $gallery = DB::transaction(function () use ($gallery, $payload) {
            $this->libraryRepository->delete(
                $gallery,
                $gallery->type == GalleryType::PHOTO ? MediaLibraryCollection::PHOTO : MediaLibraryCollection::VIDEO
            );
            $gallery = $this->galleryRepositoryWithCompany()->update($gallery, $payload);
            $this->libraryRepository->addMedia(
                $gallery,
                $payload->{$gallery->type->value},
                $gallery->type == GalleryType::PHOTO ? MediaLibraryCollection::PHOTO : MediaLibraryCollection::VIDEO
            );
            return $gallery;
        });

        Cache::tags(CacheKey::GALLERY_TAG->value)->clear();
        return $gallery;
    }

    /**
     * @param Gallery $gallery
     * @return bool
     * @throws Throwable
     */
    public function delete(Gallery $gallery): bool
    {
        throw_if(
            is_null($this->company) || $this->company->id !== $gallery->company_id,
            ModelNotFoundException::class,
            'Company not found'
        );
        $deleted = $this->galleryRepositoryWithCompany()->delete($gallery);

        if ($deleted) {
            Cache::tags(CacheKey::GALLERY_TAG->value)->clear();
        }

        return $deleted;

    }

    private function galleryRepositoryWithCompany(): GalleryRepository
    {
        return $this->galleryRepository->setCompany($this->company);
    }

}
