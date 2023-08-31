<?php

namespace App\Enums;

use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Product\Models\Product;
use App\Tbuy\Vacancy\Models\Vacancy;

enum MorphType: int
{
    case COMPANY = 1;
    case BRAND = 2;
    case PRODUCT = 3;
    case VACANCY = 4;

    public static function morphMap(): array
    {
        return [
            self::BRAND->value => Brand::class,
            self::COMPANY->value => Company::class,
            self::PRODUCT->value => Product::class,
            self::VACANCY->value => Vacancy::class
        ];
    }

    public static function getType(string $class): string
    {
        return array_flip(self::morphMap())[$class] ?? $class;
    }

    public static function getClass(mixed $morph_type): ?string
    {
        return self::morphMap()[$morph_type] ?? null;
    }

}
