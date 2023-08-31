<?php

namespace App\Tbuy\View\Repositories;

use App\Contracts\ViewableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;

interface ViewRepository
{
    public function view(ViewableContract $viewableContract, IdentifyDTO $identifyDTO);

    public function isViewed(ViewableContract $viewableContract, IdentifyDTO $identifyDTO): bool;
}
