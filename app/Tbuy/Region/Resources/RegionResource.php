<?php

namespace App\Tbuy\Region\Resources;

use App\Tbuy\Country\Resources\CountryResource;
use App\Tbuy\Region\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Region $resource
 */
class RegionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'country' => CountryResource::make($this->whenLoaded('country')),
        ];
    }
}
