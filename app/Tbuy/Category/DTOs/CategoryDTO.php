<?php

namespace App\Tbuy\Category\DTOs;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CategoryDTO extends BaseDTO
{
    public function __construct(
        public readonly array $name,
        public readonly ?int  $parent_id,
        public readonly ?int  $position,
        public readonly ?bool $is_active,
        public readonly ?int  $min_images,
        public readonly ?bool $form_description,
        public readonly ?bool $offer_services,
        public readonly array $description,
        public ?UploadedFile  $logo = null,
        public ?UploadedFile  $icon = null,

    )
    {
    }
}
