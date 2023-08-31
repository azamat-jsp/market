<?php

namespace App\Tbuy\Filial\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Filial\DTOs\FilialDTO;
use App\Tbuy\Filial\DTOs\FilialFilterDTO;
use App\Tbuy\Filial\Models\Filial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface FilialRepository extends PaginatableContract
{
    public function setCompany(Company $company): static;

    public function get(): Collection;

    public function getWithoutCompany(FilialFilterDTO $dto): Builder;

    public function create(FilialDTO $payload): Filial;

    public function update(Filial $filial, FilialDTO $payload): Filial;

    public function delete(Filial $filial): bool;

    public function getFilialList(FilialFilterDTO $payload): Collection;
}
