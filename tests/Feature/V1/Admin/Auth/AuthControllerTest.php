<?php

namespace Tests\Feature\V1\Admin\Auth;

use App\Tbuy\User\Enums\Permission;
use App\Tbuy\User\Models\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_login_success()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $this->postJson(route('api.v1.admin.auth.login'), $userData)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                    ],
                    'access_token',
                ],
                'message',
            ])
            ->assertJson([
                'message' => 'Login success',
            ]);
    }

    public function test_login_failed()
    {
        $userData = [
            'email' => 'nonexistent@example.com',
            'password' => 'invalidpassword',
        ];

        $this->postJson(route('api.v1.admin.auth.login'), $userData)
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Login failed',
            ]);
    }


    public function test_logout()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::VIEW_ANY->value);

        $this->actingAs($user)
            ->postJson(route('api.v1.admin.auth.logout'))
            ->assertOk()
            ->assertJson([
                'message' => 'Logout success',
            ]);
    }

    public function test_get_auth_user()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::VIEW_ANY->value);

        $this->actingAs($user)
            ->getJson(route('api.v1.admin.auth.user'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                ],
                'message',
            ])
            ->assertJson([
                'message' => 'Информация об авторизованном пользователе',
            ]);
    }
}
