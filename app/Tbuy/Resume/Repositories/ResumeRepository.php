<?php

namespace App\Tbuy\Resume\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Resume\DTOs\GuestResumeDTO;
use App\Tbuy\Resume\DTOs\ResumeDTO;
use App\Tbuy\Resume\DTOs\ResumeFilterDTO;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface ResumeRepository extends PaginatableContract
{
    public function store(ResumeDTO $dto): Resume;

    public function guestStore(GuestResumeDTO $dto): Resume;

    public function feedbackOnThisVacancy(Vacancy $vacancy): Collection;

    public function get(ResumeFilterDTO $dto, Company $company): Builder;

}
