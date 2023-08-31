<?php

namespace App\Tbuy\Search\Services;

use App\Tbuy\Globals;
use App\Tbuy\Search\DTOs\SearchableModelDTO;
use App\Tbuy\Search\Enums\CacheKey;
use App\Tbuy\Search\Model\SearchableModel;
use App\Tbuy\Search\Repositories\SearchableModelRepository;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class SearchableModelServiceImplementation implements SearchableModelService
{
    private SearchableModelRepository $searchableModelRepository;

    public function __construct(SearchableModelRepository $searchableModelRepository)
    {
        $this->searchableModelRepository = $searchableModelRepository;
    }

    public function get(): Collection
    {
        return Cache::remember(CacheKey::SEARCHABLE_MODEL->value, CacheKey::ttl(), function () {
            return $this->searchableModelRepository->get();
        });
    }

    public function update(SearchableModel $searchableModel, SearchableModelDTO $dto): SearchableModel
    {
        $searchableModel = $this->searchableModelRepository->update($searchableModel, $dto);

        Cache::forget(CacheKey::SEARCHABLE_MODEL->value);

        return $searchableModel;
    }

    public function delete(SearchableModel $searchableModel): void
    {
        $this->searchableModelRepository->delete($searchableModel);
    }
}
