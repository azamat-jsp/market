<?php

namespace App\Tbuy\Vacancy\Resources;

use App\Tbuy\MediaLibrary\Resources\MultipleFilesResource;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Vacancy $resource
 */
class VacancyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'salary' => $this->resource->salary,
            'status' => $this->resource->status->value,
            'address' => $this->resource->address,
            'position' => $this->resource->position,
            'working_conditions' => $this->resource->working_conditions,
            'working_type' => $this->resource->working_type,
            'deadline' => $this->resource->deadline,
            'category' => new VacancyCategoryResource($this->resource->category),
            'images' => MultipleFilesResource::collection($this->whenLoaded('images')),
            // TODO integrate with clicks and views
            'clicks' => $this->clicks_count,
            'views' => $this->views_count,
            'created_at' => $this->resource->created_at->format('d.m.Y')
        ];
    }
}
