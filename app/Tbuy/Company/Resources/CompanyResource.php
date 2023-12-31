<?php

namespace App\Tbuy\Company\Resources;

use App\Tbuy\Brand\Resources\BrandResource;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\MediaLibrary\Resources\MultipleFilesResource;
use App\Tbuy\Rejection\Resources\RejectionResource;
use App\Tbuy\Tariff\Resources\TariffResource;
use App\Tbuy\User\Resources\UserResource;
use App\Tbuy\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Company $resource
 */
class CompanyResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'legal_name_company' => $this->resource->legal_name_company,
            'description' => $this->resource->description,
            'inn' => $this->resource->inn,
            'company_address' => $this->resource->company_address,
            'phones' => $this->resource->phones->toArray(),
            'email' => $this->resource->email,
            'slug' => $this->resource->slug,
            'legal_entity' => $this->resource->legal_entity,
            'type' => $this->resource->type->value,
            'parent' => CompanyResource::make($this->whenLoaded('parent')),
            'status' => $this->resource->status,
            'logo' => $this->resource->logo?->getFullUrl() ?? "",
            'brands' => BrandResource::collection($this->whenLoaded('brands')),
            'socials' => $this->resource->socials->toArray(),
            'documents' => [
                'brand' => $this->whenLoaded('brandDocument', fn() => $this->resource->brandDocument?->getFullUrl()),
                'passport' => $this->whenLoaded('passportDocument', fn() => $this->resource->passportDocument?->getFullUrl()),
                'state_register' => $this->whenLoaded('stateRegisterDocument', fn() => $this->resource->stateRegisterDocument?->getFullUrl()),
                'identity_images' => MultipleFilesResource::collection($this->whenLoaded('identityImages')),
            ],
            'average_rating_score' => $this->whenLoaded('ratings',
                fn() => $this->resource->ratings->avg(
                    fn(?User $user) => $user?->pivot?->rating
                )
            ),
            'tariff' => TariffResource::make($this->when('tariff', fn() => $this->resource->tariff?->first())),
            'tariff_expired_at' => $this->whenLoaded('tariff', fn() => $this->resource->tariff?->first()?->pivot->expired_at),
            'user' => UserResource::make($this->whenLoaded('user')),
            'rejections' => RejectionResource::collection($this->whenLoaded('rejections')),
            'domain' => $this->domain ? ($this->domain . '.tbuy.am') : null,
            'domain_updated_at' => $this->domain_updated_at,
            'subscribers' => $this->resource->subscribers->count(),
            'percentage_of_filling' => $this->resource->percentageOfFilling
        ];
    }
}
