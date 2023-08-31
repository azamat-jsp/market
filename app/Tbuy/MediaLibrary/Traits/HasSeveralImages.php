<?php

namespace App\Tbuy\MediaLibrary\Traits;

use App\Tbuy\MediaLibrary\DTOs\FileDTO;

trait HasSeveralImages
{
    private function getFiles(array $payload, $key): array
    {
        $identity = $payload[$key] ?? [];
        return array_map(fn(array $image) => new FileDTO(...$image), $identity);
    }
}
