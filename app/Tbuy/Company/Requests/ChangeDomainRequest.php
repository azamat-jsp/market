<?php

namespace App\Tbuy\Company\Requests;

use App\Tbuy\Company\DTOs\CompanyUpdateDTO;
use App\Tbuy\Company\DTOs\DirectorDTO;
use App\Tbuy\Company\DTOs\PhonesDTO;
use App\Tbuy\Company\DTOs\SocialsDTO;
use App\Tbuy\Company\Enums\CompanyType;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\MediaLibrary\DTOs\FileDTO;
use App\Tbuy\MediaLibrary\Enums\UploadFileSize;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class ChangeDomainRequest extends FormRequest
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
        /** @var Company $company */
        $company = $this->route('company');
        if($company->domain_updated_at){
            $domainRule = Rule::in([$company->domain]);
        }

        return [
            'approve' => 'nullable',
            'domain' => [
                'nullable',
                'string',
                'max:64',
                "regex:/^([a-zA-Z0-9]*)$/m",
                Rule::unique('companies', 'domain')->ignoreModel($company),
                $domainRule ?? null
            ]
        ];
    }

    public function messages()
    {
        return [
            'domain.in' => __('validation.once', ['attribute' => 'domain'])
        ];
    }
}
