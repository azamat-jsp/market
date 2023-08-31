<?php

namespace App\Tbuy\Gallery\Repositories;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\DTOs\GalleryDTO;
use App\Tbuy\Gallery\DTOs\GalleryFilterDTO;
use App\Tbuy\Gallery\Model\Gallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class GalleryRepositoryImplementation implements GalleryRepository
{
    private ?Company $company;

    public function setCompany(Company $company): static
    {
        $this->company = $company;
        return $this;
    }

    public function get(GalleryFilterDTO $payload): Collection
    {
        return Gallery::query()
            ->when($this->company,
                fn(Builder $builder, Company $company) => $builder->where('company_id', $this->company->id)
            )
            ->filter($payload->toArray())
            ->get();
    }

    public function store(GalleryDTO $payload): Gallery
    {
        return Gallery::create($payload->toArray());
    }

    public function update(Gallery $gallery, GalleryDTO $payload): Gallery
    {
        $gallery->update((array)$payload);
        return $gallery;
    }

    public function delete(Gallery $gallery): bool
    {
        return $gallery->delete();
    }
}
