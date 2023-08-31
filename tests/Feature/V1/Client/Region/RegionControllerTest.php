<?php

namespace Tests\Feature\V1\Client\Region;

use App\Tbuy\Region\Enums\Permission;
use App\Tbuy\Region\Models\Region;
use App\Tbuy\User\Models\User;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::STORE_REGION->value);

        $region = Region::factory()->make();
        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.client.region.store'),
                data: $region->toArray(),
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name'
                ]
            ]);
    }

    public function test_store_with_invalid_data(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::STORE_REGION->value);

        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.client.region.store')
            )
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name.en',
                    'name.ru',
                    'name.hy',
                    'country_id'
                ]
            ]);
    }

    public function test_successfully_update(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::UPDATE_REGION->value);

        $region = Region::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->putJson(
                uri: route('api.v1.client.region.update', ['region' => $region->id]),
                data: $region->toArray(),
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name'
                ]
            ]);
    }

    public function test_invalid_update(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::UPDATE_REGION->value);

        $region = Region::query()->where('user_id', '<>', $user->id)->limit(1)->first();

        $this->actingAs($user)
            ->putJson(
                uri: route('api.v1.client.region.update', ['region' => $region->id]),
                data: $region->toArray(),
            )
            ->assertStatus(403)
            ->assertJsonStructure([
                'message',
                'exception'
            ]);
    }

    public function test_invalid_destroy(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::DELETE_REGION->value);

        $region = Region::query()->where('user_id', '<>', $user->id)->limit(1)->first();

        $this->actingAs($user)
            ->deleteJson(
                uri: route('api.v1.client.region.destroy', ['region' => $region->id]),
            )
            ->assertStatus(403)
            ->assertJsonStructure([
                'message',
                'exception'
            ]);
    }

    public function test_successfully_destroy(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::DELETE_REGION->value);

        $region = Region::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->deleteJson(
                uri: route('api.v1.client.region.destroy', ['region' => $region->id]),
            )
            ->assertOk()
            ->assertJsonStructure([
                'message',
            ]);
    }
}
