<?php

namespace Database\Factories;

use App\Tbuy\Category\Models\Category;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    protected $model = Resume::class;

    public function definition(): array
    {
        return [
            'vacancy_id' => Vacancy::query()->inRandomOrder()->first()->id,
            'preferred_salary' => $this->faker->randomNumber(),
            'experience' => $this->faker->numberBetween(1, 9),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
        ];
    }
}
