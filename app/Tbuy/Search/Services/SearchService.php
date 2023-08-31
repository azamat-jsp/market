<?php

namespace App\Tbuy\Search\Services;

use Illuminate\Support\Collection;

interface SearchService
{
    public function search(string $query): Collection;
}
