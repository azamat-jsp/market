<?php

namespace App\Tbuy\Resume\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Company\DTOs\DirectorDTO;
use App\Tbuy\Company\DTOs\PhonesDTO;
use App\Tbuy\Company\Enums\CompanyType;
use App\Tbuy\Resume\Requests\ResumeRequest;
use Illuminate\Http\UploadedFile;

class ResumeDTO extends BaseDTO
{
    public function __construct(
        public readonly int     $vacancy_id,
        public readonly ?int    $preferred_salary,
        public readonly ?int $category_id,
        public readonly ?int $experience,
    )
    {
    }
}
