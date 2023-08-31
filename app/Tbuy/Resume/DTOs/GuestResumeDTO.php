<?php

namespace App\Tbuy\Resume\DTOs;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class GuestResumeDTO extends BaseDTO
{
    public function __construct(
        public readonly UploadedFile    $file,
        public readonly int             $preferred_salary,
        public readonly int             $experience,
        public readonly int             $category_id,
        public readonly int             $vacancy_id,
    )
    {
    }
}
