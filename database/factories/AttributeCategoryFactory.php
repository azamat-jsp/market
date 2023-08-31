<?php

namespace Database\Factories;

use App\Tbuy\Attributable\Models\Attributable;
use App\Tbuy\Attribute\Models\Attribute;
use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use App\Tbuy\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeCategoryFactory extends Factory
{
    protected $model = AttributeCategory::class;

    public function definition(): array
    {
        /**
         * @var Attributable $attribute
         * @var Category $category
         */
        $attribute = Attribute::query()
            ->whereBetween('id', [1, 50])
            ->inRandomOrder()
            ->first();

        $category = Category::query()
            ->whereBetween('id', [1, 50])
            ->inRandomOrder()
            ->first();

        return [
            'attribute_id' => $attribute->id,
            'category_id' => $category->id,
            'keyword' => $this->faker->boolean,
            'is_multiple' => $this->faker->boolean,
            'form_name' => $this->faker->boolean,
            'required_for_organization' => $this->faker->boolean,
            'for_seo' => $this->faker->boolean,
            'position' => $this->faker->numberBetween(1, 10)
        ];
    }
}
