<?php

namespace App\Tbuy\Community\Requests;

use App\Tbuy\Community\DTOs\CommunityDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommunityRequest extends FormRequest
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
            'name' => 'array|',
            'name.ru' => 'required|string|max:100',
            'name.en' => 'required|string|max:100',
            'name.hy' => 'required|string|max:100'
        ];
    }

    public function toDto(): CommunityDTO
    {
        return new CommunityDTO(...$this->validated());
    }
}
