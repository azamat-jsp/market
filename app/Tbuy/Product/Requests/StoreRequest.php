<?php

namespace App\Tbuy\Product\Requests;

use App\Tbuy\MediaLibrary\Enums\UploadFileSize;
use App\Tbuy\MediaLibrary\Traits\HasSeveralImages;
use App\Tbuy\Product\DTOs\ProductStoreDTO;
use App\Tbuy\Product\DTOs\VisibleFieldsDTO;
use App\Tbuy\Product\Enums\ProductType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    use HasSeveralImages;

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
            'images.*' => 'array',
            'images.*.file' => 'required|file|image|mimes:jpg,jpeg,png|max:' . UploadFileSize::IMAGE->value,
            'images.*.name' => 'nullable|string',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'amount' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'size' => ['required', 'numeric'],
            'is_extended_name' => ['nullable', 'boolean'],
            'type' => ['required', new Enum(ProductType::class)],
            'active' => ['nullable', 'boolean'],
            'brand_id' => ['nullable', Rule::exists('brands', 'id')],
            'description' => 'array',
            'description.ru' => 'required|string',
            'description.en' => 'required|string',
            'description.hy' => 'required|string',
            'visible_fields' => 'present|array',
            'visible_fields.*' => 'string|max:50',

        ];
    }

    public function toDto(): ProductStoreDTO
    {
        $validated = $this->validated();
        $validated['visible_fields'] = new VisibleFieldsDTO($validated['visible_fields']);
        $validated['images'] = $this->getFiles($validated, 'images');

        return new ProductStoreDTO(...$validated);
    }
}
