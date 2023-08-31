<?php

namespace Database\Factories;

use App\Tbuy\ModelInfo\Models\ModelList;
use App\Tbuy\Search\Model\SearchableModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SearchableModel>
 */
class SearchKeyWordFactory extends Factory
{
    protected $model = SearchableModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $word = $this->faker->unique()->word;
        return [
            'name' => $word
        ];
    }
}
