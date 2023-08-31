<?php

namespace App\Tbuy\Resume\Repositories;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Tbuy\Resume\DTOs\GuestResumeDTO;
use App\Tbuy\Resume\DTOs\ResumeDTO;
use App\Tbuy\Resume\DTOs\ResumeFilterDTO;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ResumeRepositoryImplementation implements ResumeRepository
{
    use HasPaginate;
    public function __construct(
        private readonly MediaLibraryRepository $libraryRepository,
    )
    {
    }

    public function store(ResumeDTO $dto): Resume
    {
        $resume = new Resume((array)$dto);
        $resume->save();
        return $resume->load('vacancy');
    }

    public function guestStore(GuestResumeDTO $dto): Resume
    {
        $resume = Resume::create([
             "preferred_salary" => $dto->preferred_salary,
              "experience" => $dto->experience,
              "category_id" => $dto->category_id,
              "vacancy_id" => $dto->vacancy_id,
        ]);

        $this->libraryRepository->addMedia($resume, $dto->file, MediaLibraryCollection::RESUME);

        return $resume->load('file', 'vacancy', 'category');
    }

    public function feedbackOnThisVacancy(Vacancy $vacancy): Collection
    {
        return Resume::where('vacancy_id', $vacancy->id)->with('vacancy')->get();
    }

    public function get(ResumeFilterDTO $dto, Company $company): Builder
    {
        return Resume::query()
            ->whereHas('vacancy', function (Builder $builder) use ($company) {
                return $builder->where('company_id', '=', $company->id);
            })
            ->orderByDesc('created_at')
            ->with(['category', 'file', 'vacancy'])
            ->filter($dto);
    }

}
