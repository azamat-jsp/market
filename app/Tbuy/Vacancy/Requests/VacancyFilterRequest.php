<?php

namespace App\Tbuy\Vacancy\Requests;

use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class VacancyFilterRequest extends FormRequest
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
            'status' => ['nullable', 'string', new Enum(VacancyStatus::class)],
            'category_id' => ['nullable', 'int'],
            'page' => ['nullable', 'int'],
            'perPage' => ['nullable', 'int'],

        ];
    }

    public function toDto(): VacancyFilterDTO
    {
        $status = $this->get('status')
            ? VacancyStatus::tryFrom($this->get('status'))
            : null;
        return new VacancyFilterDTO(
            status: $status,
            category_id: $this->category_id,
            page: $this->page,
            perPage: $this->perPage
        );
    }
}
