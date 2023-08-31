<?php

namespace App\Tbuy\Company\Requests;

use App\Tbuy\Company\DTOs\CompanyClientLogoDTO;
use App\Tbuy\MediaLibrary\DTOs\FileDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLogoRequest extends FormRequest
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
            'logo' => 'nullable|file|image|mimes:jpg,jpeg,png|max:' . (1024 * 10),
        ];
    }

    public function toDto(): CompanyClientLogoDTO
    {
        return new CompanyClientLogoDTO(
            logo: $this->file('logo'),
        );
    }
}
