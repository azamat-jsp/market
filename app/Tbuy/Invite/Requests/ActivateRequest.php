<?php

namespace App\Tbuy\Invite\Requests;

use App\Tbuy\Invite\DTOs\InviteActivateDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ActivateRequest extends FormRequest
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
            'token' => 'required|string',
            'password' => ['required', Password::defaults()]
        ];
    }

    public function toDto(): InviteActivateDTO
    {
        return new InviteActivateDTO(...$this->validated());
    }
}