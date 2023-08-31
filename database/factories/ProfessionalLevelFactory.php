<?php

namespace Database\Factories;

use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionalLevelFactory extends Factory
{
    public $model = ProfessionalLevel::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ru' => $this->faker->word(),
                'en' => $this->faker->word(),
                'hy' => $this->faker->word()
            ],
        ];
    }
}
