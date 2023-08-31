<?php

namespace App\Tbuy\Click\Requests;

use App\Tbuy\Identify\DTOs\IdentifyDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

        ];
    }

    public function toDto(): IdentifyDTO
    {
        return new IdentifyDTO(
            user_id: $this->user('sanctum')?->id,
            ip_address: $this->ip()
        );
    }
}
