<?php

namespace App\Tbuy\AttributeCategory\Resources;

use App\Tbuy\Attribute\Resources\AttributeResource;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use App\Tbuy\Category\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read AttributeCategory $resource
 */
class AttributeCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'attribute' => AttributeResource::make($this->whenLoaded('attribute')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'is_multiple' => $this->resource->is_multiple,
            'keyword' => $this->resource->keyword,
            'required_for_organization' => $this->resource->required_for_organization,
            'form_name' => $this->resource->form_name,
            'for_seo' => $this->resource->for_seo,
            'position' => $this->resource->position,
        ];
    }
}
