<?php

namespace App\Tbuy\Community\DTOs;

use App\DTOs\BaseDTO;

class CommunityFetchDTO extends BaseDTO
{
    public function __construct(
        public readonly ?int       $page = null,
        public readonly ?int       $per_page = null,
    )
    {
    }
}
