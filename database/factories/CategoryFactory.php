<?php

namespace Database\Factories;

use App\Tbuy\Category\Enums\CategoryAttributeType;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Company\Enums\CompanyType;
use App\Tbuy\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'ru' => $this->faker->word,
                'en' => $this->faker->word,
                'hy' => $this->faker->word
            ],
            'parent_id' => null,
            'position' => $this->faker->randomNumber(),
            'is_active' => $this->faker->boolean,
            'min_images' => $this->faker->randomNumber(1, 255),
            'form_description' => $this->faker->boolean,
            'offer_services' => $this->faker->boolean,
            'type' => $this->faker->randomElement(CategoryAttributeType::cases()),
            'description' => [
                'ru' => $this->faker->paragraph,
                'en' => $this->faker->paragraph,
                'hy' => $this->faker->paragraph,
            ],
        ];
    }
}
