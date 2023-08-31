<?php

namespace App\Tbuy\Resume\Requests;

use App\Tbuy\Resume\DTOs\ResumeFilterDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResumeFilterRequest extends FormRequest
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
            'category_id' => ['nullable', 'integer'],
            'page' => ['nullable', 'integer'],
            'perPage' => ['nullable', 'integer'],
        ];
    }

    /**
     * @return ResumeFilterDTO
     */
    public function toDto(): ResumeFilterDTO
    {
        $payload = $this->validated();

        return new ResumeFilterDTO(...$payload);
    }

}
