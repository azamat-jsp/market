<?php

namespace Database\Factories;

use App\Tbuy\Vacancy\Models\VacancyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyCategoryFactory extends Factory
{
    public $model = VacancyCategory::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ru' => $this->faker->word,
                'en' => $this->faker->word,
                'hy' => $this->faker->word,            ]
        ];
    }
}
