<?php

namespace App\Tbuy\Resume\Requests;

use App\Tbuy\Resume\DTOs\GuestResumeDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuestResumeRequest extends FormRequest
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
            'file' => ['required','file','mimes:pdf'],
            'preferred_salary' => ['required', 'integer'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'vacancy_id' =>  ['required', Rule::exists('vacancies', 'id')],
            'experience' => ['required', 'integer'],
        ];
    }

    /**
     * @return GuestResumeDTO
     */
    public function toDto(): GuestResumeDTO
    {
        $payload = $this->validated();

        return new GuestResumeDTO(...$payload);
    }

}
