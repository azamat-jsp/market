<?php

namespace App\Tbuy\Vacancy\Requests;

use App\Tbuy\MediaLibrary\Enums\UploadFileSize;
use App\Tbuy\MediaLibrary\Traits\HasSeveralImages;
use App\Tbuy\Vacancy\DTOs\VacancyDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    use HasSeveralImages;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'int', Rule::exists('vacancy_categories', 'id')->where('deleted_at')],
            'title' => ['array'],
            'title.ru' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'title.hy' => ['required', 'string', 'max:255'],
            'description' => ['array'],
            'description.ru' => ['required', 'string', 'max:1000'],
            'description.en' => ['required', 'string', 'max:1000'],
            'description.hy' => ['required', 'string', 'max:1000'],
            'salary' => ['required', 'int'],
            'images.*' => 'array',
            'images.*.file' => 'required|file|image|mimes:jpg,jpeg,png|max:' . UploadFileSize::IMAGE->value,
            'images.*.name' => 'nullable|string',
            'company_id' => ['required', 'int', Rule::exists('companies', 'id')->where('deleted_at')],
            'address' => ['required', 'string'],
            'position' => ['required', 'string'],
            'deadline' => ['required', 'string', 'date'],
            'working_conditions' => ['required', 'int'],
            'working_type' => ['required', 'int'],
        ];
    }

    public function toDto(): VacancyDTO
    {
        $payload = $this->validated();
        $payload['images'] = $this->getFiles($payload, 'images');

        return new VacancyDTO(...$payload);
    }
}
