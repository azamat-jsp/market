<?php

namespace App\Tbuy\Target\Rules;

use App\Enums\MorphType;
use App\Tbuy\Target\Enums\Targetable;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckTargetableType implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $class = MorphType::getClass($value);
            if (!Targetable::tryFrom($class)) {

                $message = trans('validation.enum');

                $message = $message === 'validation.enum'
                    ? ['The selected :attribute is invalid.']
                    : $message;

                $fail($message);
            }
        } catch (\Throwable) {
            $fail($message);
        }


    }
}
