<?php

namespace Database\Factories;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use App\Tbuy\Vacancy\Models\VacancyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyFactory extends Factory
{
    public $model = Vacancy::class;

    public function definition(): array
    {
        return [
            'category_id' => VacancyCategory::query()->inRandomOrder()->value('id'),
            'title' => [
                'ru' => $this->faker->word(),
                'en' => $this->faker->word(),
                'hy' => $this->faker->word()
            ],
            'description' => [
                'ru' => $this->faker->text(),
                'en' => $this->faker->text(),
                'hy' => $this->faker->text()
            ],
            'salary' => $this->faker->numberBetween(100, 100000),
            'status' => $this->faker->randomElement(VacancyStatus::values()),
            'company_id' => Company::query()->inRandomOrder()->value('id'),
            'address' => $this->faker->word(),
            'position' => $this->faker->word(),
            'working_conditions' => $this->faker->numberBetween(1, 4),
            'working_type' => $this->faker->numberBetween(1, 4),
            'deadline' => now()->toDateTimeString()
        ];
    }
}
