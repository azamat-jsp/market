<?php

namespace App\Tbuy\Category\Requests;

use App\Tbuy\Category\DTOs\CategoryDTO;
use App\Tbuy\Category\DTOs\CategoryFilterDTO;
use App\Tbuy\Category\Enums\CategoryAttributeType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CategoryFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string', new Enum(CategoryAttributeType::class)],
            'page' => 'nullable|int',
            'perPage' => 'nullable|int',
        ];
    }

    /**
     * @return CategoryFilterDTO
     */
    public function toDto(): CategoryFilterDTO
    {
        return new CategoryFilterDTO(...$this->validated());
    }
}
