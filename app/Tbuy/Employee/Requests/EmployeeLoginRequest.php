<?php

namespace App\Tbuy\Employee\Requests;

use App\Tbuy\Employee\DTOs\EmployeeLoginDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => [
                'required',
                Rule::exists('companies', 'id')->where('deleted_at')
            ],
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }

    public function toDto(): EmployeeLoginDTO
    {
        return new EmployeeLoginDTO(...$this->validated());
    }
}
