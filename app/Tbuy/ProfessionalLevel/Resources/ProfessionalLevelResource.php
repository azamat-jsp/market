<?php

namespace App\Tbuy\ProfessionalLevel\Resources;

use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read ProfessionalLevel $resource
 */
class ProfessionalLevelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name
        ];
    }
}
