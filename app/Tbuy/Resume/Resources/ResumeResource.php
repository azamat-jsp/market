<?php

namespace App\Tbuy\Resume\Resources;

use App\Tbuy\Category\Resources\CategoryResource;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Vacancy\Resources\VacancyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Resume $resource
 */
class ResumeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'vacancy' => VacancyResource::make($this->whenLoaded('vacancy')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'preferred_salary' => $this->resource->preferred_salary,
            'experience' => $this->resource->experience,
            'created_at' => $this->resource->created_at,
            'file' => $this->whenLoaded('file')
        ];
    }
}
