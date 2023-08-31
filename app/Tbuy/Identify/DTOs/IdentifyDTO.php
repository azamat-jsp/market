<?php

namespace App\Tbuy\Identify\DTOs;

class IdentifyDTO
{
    public function __construct(
        public readonly ?int      $user_id,
        public readonly ?string   $ip_address,
        public ?int               $id = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'ip_address' => $this->ip_address
        ];
    }
}
