<?php

namespace Database\Factories;

use App\Tbuy\Company\DTOs\PhonesDTO;
use App\Tbuy\Company\Enums\CompanyStatus;
use App\Tbuy\Company\Enums\CompanyType;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();

        return [
            'name' => [
                'ru' => $this->faker->word,
                'en' => $this->faker->word,
                'hy' => $this->faker->word
            ],
            'description' => [
                'ru' => $this->faker->text,
                'en' => $this->faker->text,
                'hy' => $this->faker->text,
            ],
            'legal_name_company' => $this->faker->word,
            'type' => $this->faker->randomElement(CompanyType::cases()),
            'inn' => (string)$this->faker->numberBetween(1000000, 99999999),
            'company_address' => $this->faker->address,
            'director' => [
                'last_name' => $this->faker->lastName,
                'first_name' => $this->faker->firstName
            ],
            'phones' => new PhonesDTO(...[
                'phone_director' => $this->faker->phoneNumber,
                'phone_sales_department' => $this->faker->phoneNumber,
                'phone_marketing_department' => $this->faker->phoneNumber,
                'phone_operator' => $this->faker->phoneNumber,
                'phone_viber' => $this->faker->phoneNumber,
                'phone_whatsapp' => $this->faker->phoneNumber,
                'phone_telegram' => $this->faker->phoneNumber,
            ]),
            'email' => $this->faker->email,
            'slug' => $this->faker->unique()->slug,
            'legal_entity' => $this->faker->boolean,
            'registered_at' => now()->toDateTimeString(),
            'status' => $this->faker->randomElement(CompanyStatus::cases()),
            'user_id' => $user->id,
        ];
    }
}
