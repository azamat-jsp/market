<?php

namespace App\Tbuy\View\Repositories;

use App\Contracts\ViewableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;

class ViewRepositoryImplementation implements ViewRepository
{
    public function view(ViewableContract $viewableContract, IdentifyDTO $identifyDTO)
    {
        $viewableContract->views()->create([
            'identifier_id' => $identifyDTO->id
        ]);
    }

    public function isViewed(ViewableContract $viewableContract, IdentifyDTO $identifyDTO): bool
    {
        return $viewableContract->views()->where('identifier_id', $identifyDTO->id)->exists();
    }
}
