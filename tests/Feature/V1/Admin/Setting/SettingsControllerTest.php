<?php

namespace Tests\Feature\V1\Admin\Setting;

use App\Tbuy\Settings\Enums\Permission;
use App\Tbuy\Settings\Models\Settings;
use App\Tbuy\User\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{
    use WithFaker;

    public function test_update(): void
    {
        /**
         * @var User $user
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_SETTINGS->value,
            Permission::UPDATE_SETTINGS->value,
        ]);

        $setting = Settings::query()->inRandomOrder()->first();
        $data = [
            'value' => Str::random(),
            'supportPhone' => $this->faker->phoneNumber,
            'supportEmail' => $this->faker->email
        ];

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.admin.settings.update', ['settings' => $setting->id]),
                $data
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'type',
                    'variable',
                    'value',
                    'supportPhone',
                    'supportEmail'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $setting->id)
                    ->etc()
            );

        $this->assertDatabaseHas('settings', [
            'id' => $setting->id,
            'value' => $data['value'],
            'support_phone' => $data['supportPhone'],
            'support_email' => $data['supportEmail']
        ]);
    }
}
