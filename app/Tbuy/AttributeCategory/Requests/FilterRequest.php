<?php

namespace App\Tbuy\AttributeCategory\Requests;

use App\Tbuy\AttributeCategory\DTOs\FilterDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'perPage' => 'nullable|int',
            'page' => 'nullable|int'
        ];
    }

    public function toDto(): FilterDTO
    {
        return new FilterDTO(
            perPage: $this->get('perPage'),
            page: $this->get('page', 1)
        );
    }
}
