<?php

namespace App\Tbuy\Company\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read Media $resource
 */
class CompanyDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "filename" => $this->resource->collection_name,
            "file_type" => $this->resource->mime_type,
            "url" => $this->resource->getUrl()
        ];
    }
}
