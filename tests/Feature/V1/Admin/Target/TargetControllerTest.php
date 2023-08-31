<?php

namespace Tests\Feature\V1\Admin\Target;

use App\Enums\MorphType;
use App\Tbuy\Audience\Models\Audience;
use App\Tbuy\Target\Enums\Permission;
use App\Tbuy\Target\Enums\Status;
use App\Tbuy\Target\Enums\Targetable;
use App\Tbuy\Target\Models\Target;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Repositories\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TargetControllerTest extends TestCase
{
    use WithFaker;

    public function test_index(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::VIEW_TARGET_LIST->value);

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->getJson(route('api.v1.admin.target.index'))
            ->assertOk();
    }

    public function test_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_TARGET_LIST->value,
            Permission::CREATE_TARGET->value
        ]);

        $data = Target::factory()->raw();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->post(route('api.v1.admin.target.store'), $data)
            ->assertCreated();
    }

    public function test_show(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_TARGET_LIST->value,
        ]);

        $target = Target::factory()->create();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->get(route("api.v1.admin.target.show", $target->id))
            ->assertOk();
    }

    public function test_update(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_TARGET_LIST->value,
            Permission::UPDATE_TARGET->value
        ]);

        $target = Target::factory()->create();

        $data = Target::factory()->raw();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->putJson(route("api.v1.admin.target.update", $target->id), $data)
            ->assertOk();
    }

    public function test_destroy(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_TARGET_LIST->value,
            Permission::DELETE_TARGET->value
        ]);

        $target = Target::factory()->create();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->delete(route("api.v1.admin.target.destroy", $target->id))
            ->assertOk();
    }

    public function test_change_status(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_TARGET_LIST->value,
            Permission::CHANGE_TARGET_STATUS->value
        ]);

        $target = Target::factory()->create();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->post(
                uri: route("api.v1.admin.target.change-status", $target->id),
                data: ['status' => Status::ACCEPTED->value]
            )->assertOk();
    }

    public function test_increment_views(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_TARGET_LIST->value,
        ]);

        $target = Target::factory()->create();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->get(route("api.v1.admin.target.increment-views", $target->id))
            ->assertOk();
    }
}
