<?php

namespace App\Tbuy\Gallery\Requests;

use App\Tbuy\Gallery\DTOs\GalleryDTO;
use App\Tbuy\Gallery\Enums\GalleryType;
use App\Tbuy\Gallery\Rules\GalleryCount;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GalleryStoreRequest extends FormRequest
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
            'photo' => ['nullable', 'required_without:video', 'mimes:jpg,gif,png', 'max:' . (1024 * 2), new GalleryCount(15)],
            'video' => ['nullable', 'required_without:photo', 'mimes:mp4', 'max:' . (1024 * 20),  new GalleryCount(15)]
        ];
    }

    public function toDto(): GalleryDTO
    {
        return new GalleryDTO(
            company_id: $this->route()->company->id,
            type: $this['photo'] ? GalleryType::PHOTO->value : GalleryType::VIDEO->value,
            photo: $this['photo'],
            video: $this['video']
        );
    }
}
