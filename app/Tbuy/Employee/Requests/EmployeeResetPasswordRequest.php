<?php

namespace App\Tbuy\Employee\Requests;

use App\Tbuy\Employee\DTOs\EmployeeFilterDTO;
use App\Tbuy\Employee\DTOs\EmployeeResetPasswordDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EmployeeResetPasswordRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'min:4'],
            'username' => ['required', 'string', 'max:255', 'min:4'],
            'company_id' => ['required', 'exists:companies,id'],
        ];
    }

    public function toDto(): EmployeeResetPasswordDTO
    {
        $validated = $this->validated();

        return new EmployeeResetPasswordDTO(
            password: Str::password(8),
            email: $validated['email'],
            username: $validated['username'],
            company_id: $validated['company_id'],
        );
    }
}
