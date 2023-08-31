<?php

namespace App\Tbuy\Gallery\Resources;


use App\Tbuy\Gallery\Model\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Gallery $resource
 */
class GalleryResource extends JsonResource
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
            'src' => $this->resource->{$this->resource->type->value}?->getFullUrl(),
            'name' => $this->resource->{$this->resource->type->value}?->name,
        ];
    }
}
