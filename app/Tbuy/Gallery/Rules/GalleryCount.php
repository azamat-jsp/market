<?php

namespace App\Tbuy\Gallery\Rules;

use App\Tbuy\Company\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Throwable;

class GalleryCount implements ValidationRule
{
    public function __construct(protected int $count)
    {
    }

    /**
     * @throws Throwable
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $company = request()->company instanceof Company ? request()->company : Company::find(request()->company);

        $count = $company->galleries()->where('type', $attribute)->count();

        if ($count >= $this->count) {
            $fail('Count :attribute then less ' . $this->count);
        }
    }
}

