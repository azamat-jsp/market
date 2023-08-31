<?php

namespace App\Tbuy\Resume\Requests;

use App\Tbuy\Resume\DTOs\ResumeDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
            'vacancy_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'preferred_salary' => ['nullable', 'integer'],
            'experience' => ['nullable'],
        ];
    }

    /**
     * @return ResumeDTO
     */
    public function toDto(): ResumeDTO
    {
        $payload = $this->validated();

        return new ResumeDTO(...$payload);
    }

}
