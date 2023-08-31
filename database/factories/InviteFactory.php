<?php

namespace Database\Factories;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Invite\Models\Invite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Invite>
 */
class InviteFactory extends Factory
{
    protected $model = Invite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::query()->inRandomOrder()->value('id'),
            'email' => $this->faker->unique()->email,
            'username' => $this->faker->unique()->userName,
            'token' => Str::random(128),
            'expired_at' => $this->faker->dateTime,
            'activated_at' => $this->faker->dateTime
        ];
    }
}
