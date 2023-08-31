<?php

namespace App\Tbuy\Vacancy\Requests\Client;

use App\Tbuy\Vacancy\DTOs\Client\VacancyDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', Rule::exists('vacancy_categories', 'id')],
            'title' => ['array'],
            'title.ru' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'title.hy' => ['required', 'string', 'max:255'],
            'description' => ['array'],
            'description.ru' => ['required', 'string', 'max:1000'],
            'description.en' => ['required', 'string', 'max:1000'],
            'description.hy' => ['required', 'string', 'max:1000'],
            'salary' => ['required', 'int'],
            'address' => ['required', 'string'],
            'position' => ['required', 'string'],
            'deadline' => ['required', 'string', 'date'],
            'working_conditions' => ['required', 'int'],
            'working_type' => ['required', 'int'],
        ];
    }

    public function toDto(): VacancyDTO
    {
        return new VacancyDTO(...$this->validated());
    }
}
