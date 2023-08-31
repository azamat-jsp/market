<?php

namespace App\Tbuy\Category\Requests;

use App\Tbuy\Category\DTOs\CategoryDTO;
use App\Tbuy\Category\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => 'array',
            'name.ru' => 'required|string|max:100',
            'name.en' => 'required|string|max:100',
            'name.hy' => 'required|string|max:100',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:' . (1024 * 5),
            'position' => 'nullable|int',
            'is_active' => 'nullable|boolean',
            'min_images' => 'nullable|int',
            'form_description' => 'nullable|boolean',
            'offer_services' => 'nullable|boolean',
            'description' => 'array',
            'description.ru' => 'required|string|max:1000',
            'description.en' => 'required|string|max:1000',
            'description.hy' => 'required|string|max:1000',
            'logo' => 'required|file|image|mimes:jpg,jpeg,png|max:' . (1024 * 10),
            'icon' => 'required|file|image|mimes:jpg,jpeg,png|max:' . (1024 * 10),
            'parent_id' => ['nullable', 'int', Rule::exists('categories', 'id')],
        ];
    }

    /**
     * @return CategoryDTO
     */
    public function toDto(): CategoryDTO
    {
        return new CategoryDTO(...$this->validated());
    }
}
