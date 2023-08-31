<?php

namespace App\Tbuy\Banner\Requests\Company;

use App\Tbuy\Banner\DTOs\BannerDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name' => 'present|array',
            'name.ru' => 'required|string|max:100',
            'name.en' => 'required|string|max:100',
            'name.hy' => 'required|string|max:100',
            'content' => 'required|array',
            'content.ru' => 'required|string|max:100',
            'content.en' => 'required|string|max:100',
            'content.hy' => 'required|string|max:100',
            'file' => 'required|mimes:png,svg,jpeg,jpg,psd|max:'.(1024 * 50)
        ];
    }

    public function toDto(): BannerDTO
    {
        $data = [
            ...$this->validated(),
            ...[
                'company_id' => $this->route()->company->id,
            ]
        ];

        return new BannerDTO(...$data);
    }
}
