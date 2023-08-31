<?php

namespace App\Tbuy\Attribute\Requests;

use App\Tbuy\Attribute\DTOs\AttributeDTO;
use App\Tbuy\Attribute\Enums\AttributeType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'name' => 'array|size:3',
            'name.ru' => 'required|string|max:100',
            'name.en' => 'required|string|max:100',
            'name.hy' => 'required|string|max:100',
            'type' => ['required', 'string', new Enum(AttributeType::class)],
        ];
    }

    public function toDto(): AttributeDTO
    {
        $payload = $this->validated();
        $payload['type'] = AttributeType::tryFrom($payload['type']);

        return new AttributeDTO(...$payload);
    }
}
