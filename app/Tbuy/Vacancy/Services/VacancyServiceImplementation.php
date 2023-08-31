<?php

namespace App\Tbuy\Vacancy\Services;

use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Services\MediaLibraryService;
use App\Tbuy\Vacancy\DTOs\VacancyDTO;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Tbuy\Vacancy\DTOs\VacancyStatusDTO;
use App\Tbuy\Vacancy\Enums\VacancyCacheKey;
use App\Tbuy\Vacancy\Events\VacancyRejected;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\Repositories\VacancyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VacancyServiceImplementation implements VacancyService
{
    public function __construct(
        private readonly VacancyRepository   $vacancyRepository,
        private readonly MediaLibraryService $mediaLibraryService
    )
    {
    }

    public function get(VacancyFilterDTO $filters): LengthAwarePaginator
    {
        $query = $this->vacancyRepository->get($filters);

        return Cache::tags(VacancyCacheKey::LIST->value)
            ->remember(
                VacancyCacheKey::LIST->setKeys($filters),
                VacancyCacheKey::ttl(),
                fn() => $this->vacancyRepository->paginate($query, $filters->perPage)
            );
    }

    public function create(VacancyDTO $payload): Vacancy
    {
        $vacancy = DB::transaction(function () use ($payload) {
            $vacancy = $this->vacancyRepository->create($payload);

            if ($payload->images) {
                $this->mediaLibraryService->addAllMedia($vacancy, $payload->images, MediaLibraryCollection::VACANCY_MEDIA);
            }

            return $vacancy->load(['category', 'images']);
        });

        Cache::tags(VacancyCacheKey::LIST)->clear();

        return $vacancy;
    }

    public function update(VacancyDTO $payload, Vacancy $vacancy): Vacancy
    {
        $vacancy = DB::transaction(function () use ($payload, $vacancy) {
            $vacancy = $this->vacancyRepository->update($payload, $vacancy);

            if ($payload->images) {
                $this->mediaLibraryService->deleteFileSelectively($vacancy, $payload->images, MediaLibraryCollection::VACANCY_MEDIA);
            }

            return $vacancy->load(['category', 'images']);
        });

        Cache::tags(VacancyCacheKey::LIST)->clear();

        return $vacancy;
    }

    public function delete(Vacancy $vacancy): void
    {
        $this->vacancyRepository->delete($vacancy);

        Cache::forget(VacancyCacheKey::LIST->value);
    }

    public function toggleStatus(Vacancy $vacancy, VacancyStatusDTO $payload): Vacancy
    {
        $vacancy = DB::transaction(function () use ($vacancy, $payload) {
            $vacancy = $this->vacancyRepository->setStatus($vacancy, $payload);

            if ($vacancy->status->isArchived() || $vacancy->status->isRejected()) {
                event(new VacancyRejected($vacancy, $payload, auth()->id()));
            }

            return $vacancy;
        });

        Cache::tags(VacancyCacheKey::LIST->value)->clear();

        return $vacancy;
    }

    public function getFavoriteItems(VacancyFilterDTO $filters): LengthAwarePaginator
    {
        $query = $this->vacancyRepository->getFavoriteItems();

        return Cache::tags(VacancyCacheKey::LIST->value)
            ->remember(
                VacancyCacheKey::LIST->setKeys($filters),
                VacancyCacheKey::ttl(),
                fn() => $this->vacancyRepository->paginate($query)
            );

    }
}
