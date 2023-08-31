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

class UpdateRequest extends FormRequest
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
            'name' => 'array|size:3',
            'name.ru' => 'required|string|max:100',
            'name.en' => 'required|string|max:100',
            'name.hy' => 'required|string|max:100',
            'legal_name_company' => 'required|string|max:100',
            'description' => 'array|size:3',
            'description.ru' => 'required|string|max:1000',
            'description.en' => 'required|string|max:1000',
            'description.hy' => 'required|string|max:1000',
            'company_address' => 'required|string|max:200',
            'type' => ['required', 'string', new Enum(CompanyType::class)],
            'inn' => 'required|string|max:20',
            'director' => 'array',
            'director.first_name' => 'required|string|max:100',
            'director.last_name' => 'required|string|max:100',
            'phones' => 'array|max:7',
            'phones.phone_director' => 'required|string|max:20',
            'phones.phone_sales_department' => 'nullable|string|max:20',
            'phones.phone_marketing_department' => 'nullable|string|max:20',
            'phones.phone_operator' => 'nullable|string|max:20',
            'phones.phone_viber' => 'nullable|string|max:20',
            'phones.phone_whatsapp' => 'nullable|string|max:20',
            'phones.phone_telegram' => 'nullable|string|max:20',
            'email' => 'required|email|max:50',
            'slug' => [
                'required',
                'string',
                'max:100',
                Rule::unique('companies', 'slug')->ignoreModel($company)
            ],
            'legal_entity' => 'required|boolean',
            'brand_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:' . UploadFileSize::IMAGE->value,
            'passport_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:' . UploadFileSize::IMAGE->value,
            'state_register_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:' . UploadFileSize::IMAGE->value,
            'socials' => 'array|max:6',
            'socials.website' => 'nullable|string|url|max:200',
            'socials.facebook' => 'nullable|string|url|max:200',
            'socials.instagram' => 'nullable|string|url|max:200',
            'socials.youtube' => 'nullable|string|url|max:200',
            'socials.tiktok' => 'nullable|string|url|max:200',
            'socials.telegram' => 'nullable|string|url|max:200',
            'parent_id' => ['nullable', 'int', Rule::exists('companies', 'id')],
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

    /**
     * @return CompanyUpdateDTO
     */
    public function toDto(): CompanyUpdateDTO
    {
        /** @var Company $companyModel */
        $companyModel = $this->route('company');

        $company = $this->validated();
        $company['type'] = CompanyType::tryFrom($company['type']);
        $company['status'] = $companyModel->status->value;
        $company['director'] = new DirectorDTO(...$company['director']);
        $company['phones'] = new PhonesDTO(...$company['phones']);
        $company['socials'] = $this->has('socials') ? new SocialsDTO(...$company['socials']) : null;
        $company['parent_id'] = $company['parent_id'] ?? null;
        if (!empty($company['domain'])) {
            $company['domain_updated_at'] = now();
        }

        return new CompanyUpdateDTO(...$company);
    }

    public function messages()
    {
        return [
            'domain.in' => __('validation.once', ['attribute' => 'domain'])
        ];
    }
}
