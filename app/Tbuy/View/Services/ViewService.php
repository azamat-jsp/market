<?php

namespace App\Tbuy\View\Services;

use App\Contracts\ViewableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;

interface ViewService
{
    public function view(ViewableContract $viewableContract, IdentifyDTO $identifyDTO): void;
}
