<?php

namespace App\Tbuy\User\DTOs;

use App\DTOs\BaseDTO;

class ResetPasswordDTO extends BaseDTO
{
    public function __construct(
        public readonly string $token,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
