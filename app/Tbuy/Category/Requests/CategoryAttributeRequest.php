<?php

namespace App\Tbuy\Category\Requests;

use App\Tbuy\Category\DTOs\CategoryAttributeDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryAttributeRequest extends FormRequest
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
            'attributes' => 'required|array',
            'attributes.*' => [
                'required',
                'int',
                Rule::exists('attributes', 'id')
            ],
            'page' => 'nullable|string',
            'perPage' => 'nullable|string',
        ];
    }

    /**
     * @return CategoryAttributeDTO
     */
    public function toDto(): CategoryAttributeDTO
    {
        return new CategoryAttributeDTO(...$this->validated());
    }
}
