<?php

namespace App\Tbuy\Community\Requests;

use App\Tbuy\Community\DTOs\CommunityFetchDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommunityFetchRequest extends FormRequest
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
            'page' => 'nullable|int',
            'per_page' => 'nullable|int',
        ];
    }

    public function toDto(): CommunityFetchDTO
    {
        return new CommunityFetchDTO(...$this->validated());
    }
}
