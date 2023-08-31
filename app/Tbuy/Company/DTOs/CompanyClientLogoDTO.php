<?php

namespace App\Tbuy\Company\DTOs;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CompanyClientLogoDTO extends BaseDTO
{
    public function __construct(
        public UploadedFile        $logo,
    )
    {
    }
}
