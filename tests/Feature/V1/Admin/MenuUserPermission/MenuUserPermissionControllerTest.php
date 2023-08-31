<?php

namespace Tests\Feature\V1\Admin\MenuUserPermission;


use App\Tbuy\Menu\Enums\Permission;
use App\Tbuy\Menu\Models\Menu;
use App\Tbuy\User\Models\User;
use Tests\TestCase;

class MenuUserPermissionControllerTest extends TestCase
{
    public function test_set_user_to_menu()
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_MENU->value,
            Permission::MENU_SET_USER->value
        ]);

        $menuIds = Menu::factory(10)->create()->pluck('id')->toArray();

        $payload = [
            "user_id" => $user->id,
            'menu' => $menuIds
        ];

        $this->actingAs($user)
            ->post(route('api.v1.admin.menu.user.store'), $payload)
            ->assertCreated()
            ->assertJsonStructure([
                "success",
                "message",
            ])
            ->assertJson([
                "success" => true,
                "message" => "Menu set"
            ]);

        foreach ($menuIds as $menuId) {
            $this->assertDatabaseHas('menu_user_permission', [
                'user_id' => $user->id,
                'menu_id' => $menuId
            ]);
        }
    }
}
