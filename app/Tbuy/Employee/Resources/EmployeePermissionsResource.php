<?php

namespace App\Tbuy\Employee\Resources;

use App\Tbuy\Employee\Resources\EmployeeResource;
use App\Tbuy\Employee\Resources\EmployeePermissionStructureResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read array <string, Employee|array> $resource
 */
class EmployeePermissionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employee' => EmployeeResource::make($this->resource['employee']),
            'permissions' => EmployeePermissionStructureResource::make($this->resource['permissions'])
        ];
    }
}
