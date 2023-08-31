<?php

namespace App\Tbuy\Banner\Repositories;

use App\Tbuy\Banner\DTOs\BannerDTO;
use App\Tbuy\Banner\Models\Banner;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use Illuminate\Database\Eloquent\Collection;

class BannerRepositoryImplementation implements BannerRepository
{
    public function get(): Collection
    {
        return Banner::query()->get();
    }

    public function create(BannerDTO $payload): Banner
    {
        $banner = new Banner($payload->toArray());
        $banner->save();
        $banner->addMedia($payload->file)->toMediaCollection(MediaLibraryCollection::BANNER_FILE->value);

        return $banner;
    }

    public function update(Banner $banner, BannerDTO $payload): Banner
    {
        $banner->fill($payload->toArray());
        $banner->save();
        $banner->addMedia($payload->file)->toMediaCollection(MediaLibraryCollection::BANNER_FILE->value);

        return $banner;
    }

    public function delete(Banner $banner): bool
    {
        return $banner->delete();
    }

    public function getByCompany(Company $company): Collection
    {
        return Banner::query()->where('company_id', $company->id)->with('file')->get();
    }
}
