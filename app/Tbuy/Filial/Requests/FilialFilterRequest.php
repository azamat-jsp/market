<?php

namespace App\Tbuy\Filial\Requests;

use App\Tbuy\Filial\DTOs\FilialFilterDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilialFilterRequest extends FormRequest
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
            'company_id' => 'nullable|int',
            'from' => ['required_with:to', 'date'],
            'to' => ['required_with:from,', 'date'],
            'page' => 'nullable|int',
            'perPage' => 'nullable|int'
        ];
    }

    public function toDto(): FilialFilterDTO
    {
        return new FilialFilterDTO(
            company_id: $this->get('company_id'),
            from: $this->get('from'),
            to: $this->get('from'),
            page: $this->get('page', 1),
            perPage: $this->get('perPage')
        );
    }
}
