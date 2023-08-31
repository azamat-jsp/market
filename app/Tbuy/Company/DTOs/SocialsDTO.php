<?php

namespace App\Tbuy\Company\DTOs;

use App\DTOs\BaseDTO;

class SocialsDTO extends BaseDTO
{
    public function __construct(
        public readonly ?string $website = null,
        public readonly ?string $facebook = null,
        public readonly ?string $instagram = null,
        public readonly ?string $youtube = null,
        public readonly ?string $tiktok = null,
        public readonly ?string $telegram = null,
        public readonly ?string $whatsapp = null,
        public readonly ?string $viber = null
    )
    {
    }
}
