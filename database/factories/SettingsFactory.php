<?php

namespace Database\Factories;

use App\Tbuy\Region\Models\Region;
use App\Tbuy\Settings\Enums\SettingsType;
use App\Tbuy\Settings\Enums\SettingsVariable;
use App\Tbuy\Settings\Models\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Region>
 */
class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => SettingsType::SEARCH->value,
            'variable' => SettingsVariable::OUTPUT_COUNT->value,
            'support_phone' => "+374 77 065 065",
            'support_email' => "Commerce@tbay.am",
            'value' => '20'
        ];
    }
}
