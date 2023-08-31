<?php

namespace App\Tbuy\Company\Resources;

use App\Tbuy\Company\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property-read Company $resource
 */
class CompanyInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'legal_name_company' => $this->resource->legal_name_company,
            'logo' => $this->whenLoaded('logo',
                            fn() => $this->resource->logo?->getFullUrl()
                        ),
            'email' => $this->resource->email,
            'description' => $this->resource->description,
            'percentageFilled' => $this->resource->percentageFilled,
            'subscribersCount' => $this->resource->subscribersCount
        ];
    }
}
