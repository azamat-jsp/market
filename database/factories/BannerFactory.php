<?php

namespace Database\Factories;

use App\Tbuy\Banner\Models\Banner;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    protected $model = Banner::class;

    const USER_EMAILS_WHO_HAVE_COMPANY = [
        'oleg@admin.com',
        'ivan@admin.com',
        'vlad@admin.com',
        'aleksander@admin.com',
        'michel@admin.com',
        'gleb@admin.com',
        'tilek@admin.com',
        'jasur@admin.com',
        'backend@admin.com'
    ];

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
                'hy' => $this->faker->word,
            ],
            'content' => [
                $this->faker->word => $this->faker->word,
                $this->faker->word => $this->faker->word,
                $this->faker->word => $this->faker->word
            ],
            'company_id' => Company::query()->whereIn('user_id', User::query()->select('id')->whereIn('email', self::USER_EMAILS_WHO_HAVE_COMPANY))->inRandomOrder()->value('id')
        ];
    }
}
