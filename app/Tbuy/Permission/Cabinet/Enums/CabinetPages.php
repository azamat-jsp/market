<?php

namespace App\Tbuy\Permission\Cabinet\Enums;

enum CabinetPages: string
{
    case PERSON = 'person';
    case ADVERTISING = 'advertising';
    case SALES = 'sales';
    case PROMO = 'promo';
    case WALLET = 'wallet';
    case TARIFF = 'tariff';
    case BULLETIN = 'bulletin';
    case SHIPMENT = 'shipment';
    case REPORT = 'report';
    case MESSAGES = 'messages';
    case FAQ = 'faq';
    case SUPPORT = 'support';
    case VACANCIES = 'vacancies';
    case SERVICES = 'services';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
