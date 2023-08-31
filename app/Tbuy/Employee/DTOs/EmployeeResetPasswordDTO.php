<?php

namespace App\Tbuy\Employee\DTOs;

use App\DTOs\BaseDTO;

class EmployeeResetPasswordDTO extends BaseDTO
{
    public function __construct(
        public readonly string $password,
        public readonly string $email,
        public readonly string $username,
        public readonly int $company_id,
    )
    {
    }
}
