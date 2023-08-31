<?php

namespace App\Tbuy\Vacancy\Enums;

enum VacancyStatus: string
{
    case ACTIVE = 'active';
    case ARCHIVED = 'archived';
    case CONFIRMED = 'confirmed';
    case MODERATION = 'moderation';
    case NEW = 'new';
    case PENDING = 'pending';
    case REJECTED = 'rejected';

    public function isRejected(): bool
    {
        return $this->value === self::REJECTED->value;
    }

    public function isArchived(): bool
    {
        return $this->value === self::ARCHIVED->value;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
