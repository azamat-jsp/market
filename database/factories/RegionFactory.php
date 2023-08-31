<?php

namespace Database\Factories;

use App\Tbuy\Country\Models\Country;
use App\Tbuy\Region\Models\Region;
use App\Tbuy\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Region>
 */
class RegionFactory extends Factory
{
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->city,
                'ru' => $this->faker->city,
                'hy' => $this->faker->city
            ],
            'country_id' => Country::query()->inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->first()->id
        ];
    }
}
