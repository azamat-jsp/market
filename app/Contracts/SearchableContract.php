<?php

namespace App\Contracts;

use Illuminate\Http\Resources\Json\JsonResource;

interface SearchableContract
{
    public function searchableAs(): string;

    public function toSearchableArray(): array;

    public static function getResourceClass(): string;
}
