<?php

namespace App\Tbuy\AttributeCategory\Requests;

use App\Tbuy\AttributeCategory\DTOs\AttributeCategoryDTO;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'attribute_id' => [
                'required',
                'integer',
                Rule::exists('attributes', 'id')->where('deleted_at')
            ],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->where('deleted_at')
            ],
            'is_multiple' => 'required|boolean',
            'keyword' => 'nullable|boolean',
            'required_for_organization' => 'required|boolean',
            'form_name' => 'nullable|boolean',
            'for_seo' => 'nullable|boolean',
            'position' => 'required|integer|digits_between:1,10',
        ];
    }

    public function toDto(): AttributeCategoryDTO
    {
        return new AttributeCategoryDTO(...$this->validated());
    }
}
