<?php

namespace App\Tbuy\Invite\DTOs;

use App\DTOs\BaseDTO;
use Illuminate\Support\Carbon;

class InviteDTO extends BaseDTO
{
    public readonly ?Carbon $expired_at;

    public function __construct(
        public readonly int    $company_id,
        public readonly string $email,
        public readonly string $username,
        public ?string         $token = null,
    )
    {
        $this->expired_at = Carbon::now()->addMinutes(60);
    }
}
