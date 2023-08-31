<?php

namespace App\Tbuy\Click\Repositories;

use App\Contracts\ClickableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;

class ClickRepositoryImplementation implements ClickRepository
{
    public function click(ClickableContract $clickableContract, IdentifyDTO $identifyDTO)
    {
        $clickableContract->clicks()->create([
            'identifier_id' => $identifyDTO->id
        ]);
    }
}
