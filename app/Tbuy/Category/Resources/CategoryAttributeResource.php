<?php

namespace App\Tbuy\Category\Resources;

use App\Tbuy\Attribute\Models\Attribute;
use App\Tbuy\AttributeValue\Resources\AttributeValueResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @property-read Attribute $resource
 */
class CategoryAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        {
            return [
                'id' => $this->id,
                'for_seo' => $this->resource->for_seo,
                'form_name' => $this->resource->form_name,
                'keyword' => $this->resource->keyword,
                'is_multiple' => $this->resource->is_multiple,
                'position' => $this->resource->position,
                'name' => $this->resource->getTranslations('name'),
                'values' => AttributeValueResource::collection($this->whenLoaded('values'))
            ];
        }
    }
}
