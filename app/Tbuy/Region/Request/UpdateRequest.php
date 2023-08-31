<?php

namespace App\Tbuy\Region\Request;

use App\Tbuy\Region\DTOs\RegionDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'array',
            'name.ru' => 'required|string|max:100',
            'name.en' => 'required|string|max:100',
            'name.hy' => 'required|string|max:100',
            'country_id' => [
                'required',
                Rule::exists('countries', 'id')->whereNull('deleted_at'),
                'int'
            ],
        ];
    }
    public function toDto(): RegionDTO
    {
        return new RegionDTO(
            $this->name,
            $this->country_id,
            auth()->user()->id
        );
    }
}
