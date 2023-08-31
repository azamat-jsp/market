<?php

namespace App\Tbuy\Audience\Repositories;

use App\Tbuy\Audience\DTOs\AudienceDTO;
use App\Tbuy\Audience\Models\Audience;
use Illuminate\Database\Eloquent\Collection;

class AudienceRepositoryImplementation implements AudienceRepository
{
    public function get(): Collection
    {
        return Audience::query()
            ->with(['company', 'country', 'region'])
            ->get();
    }

    public function create(AudienceDTO $dto): Audience
    {
        $audience = new Audience($dto->toArray());
        $audience = $this->addTranslations($dto, $audience);
        $audience->save();

        return $audience->load(['company', 'country', 'region']);
    }

    public function show(Audience $audience): Audience
    {
        return $audience->load(['company', 'country', 'region']);
    }

    public function update(AudienceDTO $dto, Audience $audience): Audience
    {
        $audience->fill($dto->toArray());
        $audience = $this->addTranslations($dto, $audience);
        $audience->save();

        return $audience->load(['company', 'country', 'region']);
    }

    public function delete(Audience $audience): void
    {
        $audience->delete();
    }

    private function addTranslations(AudienceDTO $dto, Audience $audience): Audience
    {
        return $audience->setTranslations('name', $dto->name);
    }
}
