<?php

namespace App\Traits;

use App\Tbuy\Search\Model\SearchableField;
use App\Tbuy\Search\Model\SearchKeyWord;
use App\Tbuy\Search\Model\SearchKeyWordSearchable;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;

trait SearchableTrait
{
    use Searchable;

    public function toSearchableArray(): array
    {
        $output = [];

        $fields = SearchableField::query()->with([
            'searchableModel.modelList',
            'modelField'
        ])->whereHas('searchableModel.modelList', fn(Builder $q) => $q->where('model', self::class))
            ->orderBy('priority', 'DESC')->get();

        foreach ($fields as $field) {
            $output[$field->modelField->slug] = $this->{$field->modelField?->slug};
        }

        $output['key_words'] = implode(
            '',
            $this->searchKeyWords()->map(
                fn(SearchKeyWord $word) => $word->name
            )->toArray()
        );

        return $output;
    }

    public function searchableAs(): string
    {
        return config('scout.searchableAs');
    }

    public function searchKeyWords(): Collection
    {
        $ids = SearchKeyWordSearchable::query()
            ->where('key_word_type', self::class)
            ->where('key_word_id', $this->id)
            ->get('id')
            ->map(fn($item) => $item->id)
            ->toArray();

        return SearchKeyWord::query()->find($ids);
    }
}
