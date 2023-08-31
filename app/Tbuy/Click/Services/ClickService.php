<?php

namespace App\Tbuy\Click\Services;

use App\Contracts\ClickableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;

interface ClickService
{
    public function click(ClickableContract $clickableContract, IdentifyDTO $identifyDTO): void;
}
