<?php

namespace Database\Factories;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\Enums\GalleryType;
use App\Tbuy\Gallery\Model\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::query()->inRandomOrder()->value('id'),
            'type' => $this->faker->randomElement(GalleryType::cases())
        ];
    }
}
