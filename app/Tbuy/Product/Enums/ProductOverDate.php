<?php

namespace App\Tbuy\Product\Enums;

enum ProductOverDate: int
{
    /**
     * Количество дней после активации
     * @uses \App\Console\Commands\ActualizationProductCommand
     */
    case LEFT_DAYS_COUNT = 60;
}
