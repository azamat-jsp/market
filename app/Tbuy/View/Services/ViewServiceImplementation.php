<?php

namespace App\Tbuy\View\Services;

use App\Contracts\ViewableContract;
use App\Tbuy\Identify\DTOs\IdentifyDTO;
use App\Tbuy\Identify\Repositories\IdentifyRepository;
use App\Tbuy\View\Repositories\ViewRepository;

class ViewServiceImplementation implements ViewService
{
    public function __construct(
        private readonly ViewRepository     $viewRepository,
        private readonly IdentifyRepository $identifyRepository
    )
    {

    }

    public function view(ViewableContract $viewableContract, IdentifyDTO $identifyDTO): void
    {
        $identifier = $this->identifyRepository->findByUserId($identifyDTO);
        if (!$identifier) {
            $identifier = $this->identifyRepository->findByIpAddress($identifyDTO);
        }
        if (!$identifier) {
            $identifier = $this->identifyRepository->store($identifyDTO);
        }
        $identifyDTO->id = $identifier->id;

        if (!$this->viewRepository->isViewed($viewableContract, $identifyDTO)) {
            $this->viewRepository->view($viewableContract, $identifyDTO);
        }
    }
}
