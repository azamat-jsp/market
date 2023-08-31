<?php

namespace App\Tbuy\Tariff\Exceptions;

use Exception;
use Throwable;

class BalanceNotEnoughException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Недостаточно средств', $code, $previous);
    }
}
