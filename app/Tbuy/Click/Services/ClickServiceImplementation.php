<?php

namespace App\Tbuy\Click\Services;

use App\Contracts\ClickableContract;
use App\Tbuy\Click\Repositories\ClickRepository;
use App\Tbuy\Identify\DTOs\IdentifyDTO;
use App\Tbuy\Identify\Repositories\IdentifyRepository;

class ClickServiceImplementation implements ClickService
{
    public function __construct(
        private readonly ClickRepository $clickRepository,
        private readonly IdentifyRepository $identifyRepository
    ) {

    }

    public function click(ClickableContract $clickableContract, IdentifyDTO $identifyDTO): void
    {
        $identifier = $this->identifyRepository->findByUserId($identifyDTO);
        if (!$identifier) {
            $identifier = $this->identifyRepository->findByIpAddress($identifyDTO);
        }
        if (!$identifier) {
            $identifier = $this->identifyRepository->store($identifyDTO);
        }
        $identifyDTO->id = $identifier->id;

        $this->clickRepository->click($clickableContract, $identifyDTO);
    }
}
