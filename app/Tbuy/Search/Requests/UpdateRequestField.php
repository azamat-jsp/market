<?php

namespace App\Tbuy\Search\Requests;

use App\Tbuy\Search\DTOs\SearchableFieldDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequestField extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'priority' => 'required|int',
            'is_enabled' => ['boolean'],
        ];
    }

    /**
     * @return SearchableFieldDTO
     */
    public function toDto(): SearchableFieldDTO
    {
        return new SearchableFieldDTO(...$this->validated());
    }
}
