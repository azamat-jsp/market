<?php

namespace Tests\Feature\V1\Admin\ProfessionalLevel;

use App\Tbuy\ProfessionalLevel\Enums\Permission;
use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use App\Tbuy\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProfessionalLevelControllerTest extends TestCase
{
    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_LEVEL_LIST->value,
            Permission::CREATE_LEVEL->value,
        ]);

        $data = ProfessionalLevel::factory()->raw();

        $this->actingAs($user)
            ->postJson(route('api.v1.admin.professional-levels.store'), $data)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );

        $this->assertDatabaseHas('professional_levels', [
            'name->ru' => $data['name']['ru'],
            'name->en' => $data['name']['en'],
            'name->hy' => $data['name']['hy']
        ]);
    }

    public function test_successfully_update(): void
    {
        /**
         * @var User $user
         * @var ProfessionalLevel $professionalLevel
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_LEVEL_LIST->value,
            Permission::UPDATE_LEVEL->value,
        ]);

        $professionalLevel = ProfessionalLevel::query()->inRandomOrder()->first();
        $data = ProfessionalLevel::factory()->raw();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.admin.professional-levels.update', ['level' => $professionalLevel->id]),
                $data
            )
            ->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $professionalLevel->id)
                    ->etc()
            );

        $this->assertDatabaseHas('professional_levels', [
            'id' => $professionalLevel->id,
            'name->ru' => $data['name']['ru'],
            'name->en' => $data['name']['en'],
            'name->hy' => $data['name']['hy']
        ]);
    }

    public function test_successfully_destroy(): void
    {
        /**
         * @var User $user
         * @var ProfessionalLevel $professionalLevel
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_LEVEL_LIST->value,
            Permission::DELETE_LEVEL->value,
        ]);

        $professionalLevel = ProfessionalLevel::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->delete(route('api.v1.admin.professional-levels.destroy', ['level' => $professionalLevel->id]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message'
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
    }
}
