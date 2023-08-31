<?php

namespace Database\Factories;

use App\Tbuy\Audience\Enums\Gender;
use App\Tbuy\Audience\Models\Audience;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Country\Models\Country;
use App\Tbuy\Region\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AudienceFactory extends Factory
{
    protected $model = Audience::class;

    public function definition(): array
    {
        /**
         * @var Company $company
         * @var Country $country
         * @var Region $region
         */
        $company = Company::query()->inRandomOrder()->first();
        $country = Country::query()->inRandomOrder()->first();
        $region = Region::query()->inRandomOrder()->first();

        return [
            'name' => [
                'ru' => $this->faker->name(),
                'en' => $this->faker->name(),
                'hy' => $this->faker->name(),
            ],
            'company_id' => $company->id,
            'country_id' => $country->id,
            'region_id' => $region->id,
            'gender' => $this->faker->randomElement(Gender::cases())->value,
            'age' => [
                'min' => $this->faker->randomNumber(1),
                'max' => $this->faker->randomNumber(2)
            ],
        ];
    }
}
