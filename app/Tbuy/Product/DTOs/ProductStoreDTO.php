<?php

namespace App\Tbuy\Product\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Product\Enums\ProductType;

class ProductStoreDTO extends BaseDTO
{
    public readonly ?ProductType $type;

    public function __construct(
        public readonly int              $category_id,
        public readonly array            $name,
        public readonly array            $description,
        public readonly VisibleFieldsDTO $visible_fields,
        public readonly array            $images = [],
        public readonly ?float           $amount = null,
        public readonly ?float           $price = null,
        public readonly ?bool            $active = false,
        public readonly ?int             $brand_id = null,
        public readonly ?float             $size = 0,
        public readonly ?bool            $is_extended_name = false,
        ?string                          $type = null,
    )
    {
        $this->type = $type ? ProductType::from($type) : null;
    }
}
