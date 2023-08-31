<?php

namespace App\Tbuy\Category\Resources;

use App\Tbuy\Attribute\Resources\AttributeResource;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Product\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Category $resource
 */
class CategoryResource extends JsonResource
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
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'parent_id' => $this->resource->parent_id,
            'position' => $this->resource->position,
            'is_active' => $this->resource->is_active,
            'min_images' => $this->resource->min_images,
            'form_description' => $this->resource->form_description,
            'offer_services' => $this->resource->offer_services,
            'description' => $this->resource->description,
            'type' => $this->resource->type,
            'logo' => optional($this->resource->logo)->getUrl() ?? "",
            'icon' => optional($this->resource->icon)->getUrl() ?? "",
        ];
    }
}
