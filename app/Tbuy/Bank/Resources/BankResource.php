<?php

namespace App\Tbuy\Bank\Resources;

use App\Tbuy\Bank\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    public function toArray(Request $request)
    {
        /** @var Bank $this */
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
