<?php

namespace App\Tbuy\Gallery\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Gallery\Enums\GalleryType;

class GalleryFilterDTO extends BaseDTO
{
    /**
     * Создать новый экземпляр класса GalleryFilterDTO.
     *
     * @param GalleryType|null $type Тип файла.
     */
    public function __construct(
        public readonly ?GalleryType $type = null,
    )
    {
    }

}
