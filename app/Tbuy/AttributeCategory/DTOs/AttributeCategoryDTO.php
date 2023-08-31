<?php

namespace App\Tbuy\AttributeCategory\DTOs;

use App\DTOs\BaseDTO;

class AttributeCategoryDTO extends BaseDTO
{
    public function __construct(
        public readonly int     $attribute_id,
        public readonly int     $category_id,
        public readonly bool    $is_multiple,
        public readonly bool    $required_for_organization,
        public readonly ?bool   $form_name = null,
        public readonly int     $position,
        public readonly ?bool   $for_seo = null,
        public readonly ?bool   $keyword = null,
    )
    {
    }
}
