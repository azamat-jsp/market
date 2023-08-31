<?php

namespace App\Tbuy\MediaLibrary\DTOs;

use Illuminate\Http\UploadedFile;

class FileDTO
{
    public function __construct(
        public readonly UploadedFile $file,
        public readonly ?string      $name = null
    )
    {
    }
}
