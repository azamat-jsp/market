<?php

namespace App\Traits;

trait PermissionTrait
{
    public function toString(): string
    {
        return "permission:$this->value";
    }
}
