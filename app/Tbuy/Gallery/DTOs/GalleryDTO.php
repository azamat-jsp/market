<?php

namespace App\Tbuy\Gallery\DTOs;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class GalleryDTO extends BaseDTO
{
    /**
     * Создать новый экземпляр класса GalleryDTO.
     *
     * @param int $company_id id компании.
     * @param string $type тип контента.
     * @param UploadedFile|null $photo фотография для галереи компании.
     * @param UploadedFile|null $video видео для галереи компании.
 */
    public function __construct(
        public readonly int           $company_id,
        public readonly string        $type,
        public readonly ?UploadedFile $photo = null,
        public readonly ?UploadedFile $video = null,
    )
    {
    }

}
