<?php

namespace App\Tbuy\Invite\DTOs;

use App\DTOs\BaseDTO;

class InviteActivateDTO extends BaseDTO
{
    public function __construct(
        public readonly string $token,
        public readonly string $password,
    )
    {
    }
}
