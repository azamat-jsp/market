<?php

namespace Database\Factories;

use App\Enums\MorphType;
use App\Tbuy\Audience\Models\Audience;
use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Product\Models\Product;
use App\Tbuy\Target\Enums\Status;
use App\Tbuy\Target\Models\Target;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TargetFactory extends Factory
{
    protected $model = Target::class;

    public function definition(): array
    {
        $targetable = $this->faker->randomElement([
            Product::query()->inRandomOrder()->first(),
            Brand::query()->inRandomOrder()->first(),
            Company::query()->inRandomOrder()->first()
        ]);
        $audience = Audience::query()->inRandomOrder()->first();

        return [
            'name' => [
                'ru' => $this->faker->word,
                'en' => $this->faker->word,
                'hy' => $this->faker->word,
            ],
            'audience_id' => $audience->id,
            'targetable_type' => MorphType::getType($targetable::class),
            'targetable_id' => $targetable->id,
            'link' => $this->faker->url,
            'duration' => mt_rand(-30, -1),
            'status' => $this->faker->randomElement(Status::cases())->value,
            'views' => $this->faker->randomNumber(),
            'started_at' => Carbon::now(),
            'finished_at' => Carbon::now(),
        ];
    }
}
