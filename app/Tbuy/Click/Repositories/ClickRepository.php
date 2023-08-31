<?php

namespace App\Tbuy\Click\Repositories;

use App\Contracts\ClickableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;

interface ClickRepository
{
    public function click(ClickableContract $clickableContract, IdentifyDTO $identifyDTO);
}
