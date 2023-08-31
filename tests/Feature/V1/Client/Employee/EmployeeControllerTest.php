<?php

namespace Tests\Feature\V1\Client\Employee;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Employee\Enums\Permission;
use App\Tbuy\Employee\Models\CompanyEmployee;
use App\Tbuy\User\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    public function test_store(): void
    {
        /**
         * @var User $user
         * @var User $userActing
         */
        $userActing = User::query()->first();
        $userActing->givePermissionTo([
            Permission::ViEW_COMPANY_EMPLOYEE->value,
            Permission::STORE_COMPANY_EMPLOYEE->value,
        ]);

        $user = User::factory()->create();
        $data = [
            'company_id' => Company::query()->inRandomOrder()->first()->id,
            'email' => $user->email,
            'username' => Str::random(),
            'permissions' => []
        ];

        $this
            ->actingAs($userActing)
            ->withHeader('Accept', 'application/json')
            ->post(
                uri: route('api.v1.client.employee.store'),
                data: $data
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'balance',
                        'created_at'
                    ],
                    'username',
                    'company' => [
                        'id',
                        'name',
                        'description',
                        'inn',
                        'company_address',
                        'phones' => [
                            'phone_director',
                            'phone_sales_department',
                            'phone_marketing_department',
                            'phone_operator',
                            'phone_viber',
                            'phone_whatsapp',
                            'phone_telegram',
                        ],
                        'email',
                        'slug',
                        'legal_entity',
                        'type',
                        'status',
                        'socials' => [
                            'website',
                            'facebook',
                            'instagram',
                            'youtube',
                            'tiktok',
                            'telegram'
                        ],
                        'documents',
                        'tariff'
                    ],
                    'registered_at'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );

        $this->assertDatabaseHas('company_employees', [
            'company_id' => $data['company_id'],
            'username' => $data['username']
        ]);
    }

    public function test_update(): void
    {
        /**
         * @var User $user
         * @var User $userActing
         */
        $userActing = User::query()->first();
        $userActing->givePermissionTo([
            Permission::ViEW_COMPANY_EMPLOYEE->value,
            Permission::UPDATE_COMPANY_EMPLOYEE->value,
        ]);

        $user = User::query()->inRandomOrder()->first();
        $companyEmployee = CompanyEmployee::query()->inRandomOrder()->first();

        $data = [
            'company_id' => Company::query()->inRandomOrder()->value('id'),
            'email' => $user->email,
            'username' => Str::random(),
            'permissions' => [
                [
                    'key' => 'person',
                    'can' => 'can_edit'
                ]
            ]
        ];

        $this
            ->actingAs($userActing)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.client.employee.update', ['employee' => $companyEmployee->id]),
                $data
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'balance',
                        'created_at'
                    ],
                    'username',
                    'company' => [
                        'id',
                        'name',
                        'description',
                        'inn',
                        'company_address',
                        'phones' => [
                            'phone_director',
                            'phone_sales_department',
                            'phone_marketing_department',
                            'phone_operator',
                            'phone_viber',
                            'phone_whatsapp',
                            'phone_telegram',
                        ],
                        'email',
                        'slug',
                        'legal_entity',
                        'type',
                        'status',
                        'socials' => [
                            'website',
                            'facebook',
                            'instagram',
                            'youtube',
                            'tiktok',
                            'telegram'
                        ],
                        'documents',
                        'tariff'
                    ],
                    'registered_at'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $companyEmployee->id)
                    ->etc()
            );

        $this->assertDatabaseHas('company_employees', [
            'id' => $companyEmployee->id,
            'company_id' => $data['company_id'],
            'username' => $data['username']
        ]);
    }

    public function test_destroy(): void
    {
        /**
         * @var User $user
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::ViEW_COMPANY_EMPLOYEE->value,
            Permission::DELETE_COMPANY_EMPLOYEE->value,
        ]);

        $companyEmployee = CompanyEmployee::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->deleteJson(
                route('api.v1.client.employee.delete', ['employee' => $companyEmployee->id])
            )
            ->assertOk()
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

    public function test_login(): void
    {
        $companyEmployee = CompanyEmployee::query()->inRandomOrder()->first();
        $companyEmployee->update(['password' => bcrypt('password')]);

        $data = [
            'company_id' => $companyEmployee->company_id,
            'email' => $companyEmployee->user->email,
            'password' => 'password'
        ];
        $this->withHeader('Accept', 'application/json')
            ->post(route('api.v1.client.employee.login'), $data)
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user',
                    'access_token'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_login_failed(): void
    {
        $companyEmployee = CompanyEmployee::query()->inRandomOrder()->first();
        $data = [
            'company_id' => $companyEmployee->company_id,
            'email' => $companyEmployee->user->email,
            'password' => 'password123'
        ];

        $this->withHeader('Accept', 'application/json')
            ->post(route('api.v1.client.employee.login'), $data)
            ->assertStatus(401)
            ->assertJsonStructure([
                'success',
                'message'
            ]);
    }
}
