<?php

namespace App\Tbuy\ProfessionalLevel\Requests;

use App\Tbuy\ProfessionalLevel\DTOs\ProfessionalLevelDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['array'],
            'name.ru' => ['required', 'string', 'max:255'],
            'name.en' => ['required', 'string', 'max:255'],
            'name.hy' => ['required', 'string', 'max:255']
        ];
    }

    public function toDto(): ProfessionalLevelDTO
    {
        return new ProfessionalLevelDTO(...$this->validated());
    }
}
