<?php

namespace App\Tbuy\Gallery\Requests;

use App\Tbuy\Gallery\DTOs\GalleryFilterDTO;
use App\Tbuy\Gallery\Enums\GalleryType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GalleryFilterRequest extends FormRequest
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
            'type' => ['nullable', 'string'],
        ];
    }

    public function toDto(): GalleryFilterDTO
    {
        $type = $this->get('type');

        $type = GalleryType::tryFrom($type) ?? GalleryType::PHOTO;

        return new GalleryFilterDTO($type);
    }
}
