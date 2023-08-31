<?php

namespace App\Tbuy\Gallery\Repositories;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\DTOs\GalleryDTO;
use App\Tbuy\Gallery\DTOs\GalleryFilterDTO;
use App\Tbuy\Gallery\Model\Gallery;
use Illuminate\Database\Eloquent\Collection;

interface GalleryRepository
{
    public function setCompany(Company $company): static;

    public function get(GalleryFilterDTO $payload): Collection;

    public function store(GalleryDTO $payload): Gallery;

    public function update(Gallery $gallery, GalleryDTO $payload): Gallery;

    public function delete(Gallery $gallery): bool;

}
