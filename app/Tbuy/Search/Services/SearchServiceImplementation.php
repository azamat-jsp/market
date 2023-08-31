<?php

namespace App\Tbuy\Search\Services;

use App\Tbuy\Globals;
use App\Tbuy\Search\Model\SearchableModel;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class SearchServiceImplementation implements SearchService
{
    public function search(string $query): Collection
    {
        $models = config('search-ratings.models');
        /** @var \Illuminate\Database\Eloquent\Collection $inputModels */
        $inputModels = SearchableModel::query()->with('modelList')
            ->whereHas('modelList', fn(Builder $q) => $q->whereIn('model', $models))
            ->orderBy('priority', 'desc')->get();

        // Находим сумму всех приоритетов (20)
        $prioritiesCount = $inputModels->sum('priority');
        // Берём процент выдачи на единицу приоритета (1 / 20 = 0.05)
        $onePriority = 1 / max($prioritiesCount, 1);
        // Колличество эллементов в выдаче (20)
        $outputCount = Globals::OUTPUT_COUNT;
        // Результат выдачи
        $outputCollection = [];

        // Если где-то мы не доберём до нужного колличества, мы скажем на следующей итерации дать больший приоритет другой моделе
        $limitOffset = 0;
        /** @var SearchableModel[] $model */
        foreach ($inputModels as $model) {
            $modelClass = $model->modelList->model;

            $wrapKey = explode('\\', $modelClass);
            $wrapKey = end($wrapKey);
            $wrapKey = lcfirst($wrapKey);

            /** @var JsonResource $resourceClass */
            $resourceClass = $modelClass::getResourceClass();
            $priority = $model->priority; // 8
            // Считаем приоритет для текущей моделе
            // (0.4 = 8 * 0.05)
            $percentPerModel = $priority * $onePriority;
            // 8 = 20 * 0.4
            $outputModelCount = ceil($percentPerModel * $outputCount);
            // Достаём модели
            $result = $modelClass::search($query)->get()->take($outputModelCount + $limitOffset);
            // Добавляем в результат
            $outputCollection[$wrapKey] = $resourceClass::collection($result);
            // Если не добрали нужное колличество результатов
            $resultsCount = $result->count();
            // Отнимаем от ожидаемого колличества результатов реальное колличество
            $limitOffset = abs($outputModelCount - $resultsCount);
        }


        return Collection::wrap($outputCollection);
    }
}
