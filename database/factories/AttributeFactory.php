<?php

namespace Database\Factories;

use App\Tbuy\Attribute\Enums\AttributeType;
use App\Tbuy\Attribute\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attribute>
 */
class AttributeFactory extends Factory
{
    protected $model = Attribute::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'ru' => $this->faker->word(),
                'en' => $this->faker->word(),
                'hy' => $this->faker->word()
            ],
            'type' => $this->faker->randomElement(AttributeType::cases()),
            'content_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
