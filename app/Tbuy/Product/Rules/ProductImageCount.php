<?php

namespace App\Tbuy\Product\Rules;

use App\Tbuy\Category\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductImageCount implements ValidationRule
{
    public function __construct(
        protected readonly int $categoryId
    )
    {
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $category = Category::query()->findOrFail($this->categoryId);

       if ($category->min_images <= count($value)) {
           $fail('validation.attributes.min_images')->translate();
       }
    }
}
