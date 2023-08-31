<?php

namespace App\Tbuy\Settings\DTOs;

class SettingsDTO
{
    public function __construct(
        public readonly string $value,
        public readonly ?string $type = null,
        public readonly ?string $variable = null,
        public readonly ?string $supportPhone = null,
        public readonly ?string $supportEmail = null,
    ) {
    }
}
