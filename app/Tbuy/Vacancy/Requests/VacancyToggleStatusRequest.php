<?php

namespace App\Tbuy\Vacancy\Requests;

use App\Tbuy\Vacancy\DTOs\VacancyStatusDTO;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class VacancyToggleStatusRequest extends FormRequest
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
            'status' => [
                'required',
                'string',
                new Enum(VacancyStatus::class),
                Rule::exists('vacancies', 'deleted_at')->withoutTrashed()
            ],
            'reason_id' => [
                'nullable',
                'required_if:status,' . VacancyStatus::REJECTED->value,
                'integer',
                Rule::exists('reasons', 'id')
            ]
        ];
    }

    public function toDto(): VacancyStatusDTO
    {
        return new VacancyStatusDTO(...$this->validated());
    }
}
