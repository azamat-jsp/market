<?php

namespace Tests\Feature\V1\Admin\Audience;

use App\Tbuy\Audience\Enums\Permission;
use App\Tbuy\Audience\Models\Audience;
use App\Tbuy\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AudienceControllerTest extends TestCase
{
    public function test_index(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_AUDIENCE_LIST->value,
        ]);

        $audiences_count = Audience::query()->count();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->getJson(
                route('api.v1.admin.audience.index')
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'company' => [
                            'id',
                            'name',
                            'legal_name_company',
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
                            'type',
                            'status',
                            'logo',
                            'socials' => [
                                'website',
                                'facebook',
                                'instagram',
                                'youtube',
                                'tiktok',
                                'telegram',
                                'whatsapp',
                                'viber'
                            ],
                            'documents',
                            'tariff',
                            'domain',
                            'domain_updated_at',
                            'subscribers',
                            'percentage_of_filling',
                        ],
                        'country' => ['id', 'name', 'code'],
                        'region' => ['id', 'name'],
                        'gender',
                        'age' => ['min', 'max']
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->has('data', $audiences_count)
                    ->etc()
            );
    }

    public function test_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_AUDIENCE_LIST->value,
            Permission::CREATE_AUDIENCE->value
        ]);

        $data = Audience::factory()->raw();
        $data['age']['max'] = $data['age']['min'] + 10;

        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.admin.audience.store'),
                data: $data
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'company' => [
                        'id',
                        'name',
                        'legal_name_company',
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
                        'type',
                        'status',
                        'logo',
                        'socials' => [
                            'website',
                            'facebook',
                            'instagram',
                            'youtube',
                            'tiktok',
                            'telegram',
                            'whatsapp',
                            'viber'
                        ],
                        'documents',
                        'tariff',
                        'domain',
                        'domain_updated_at',
                        'subscribers',
                        'percentage_of_filling',
                    ],
                    'country' => ['id', 'name', 'code'],
                    'region' => ['id', 'name'],
                    'gender',
                    'age' => ['min', 'max']
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );

        $this->assertDatabaseHas('audiences', [
            'name->ru' => $data['name']['ru'],
            'name->en' => $data['name']['en'],
            'name->hy' => $data['name']['hy'],
            'gender' => $data['gender'],
            'age->min' => $data['age']['min'],
            'age->max' => $data['age']['max'],
            'region_id' => $data['region_id'],
            'country_id' => $data['country_id'],
            'company_id' => $data['company_id']
        ]);
    }

    public function test_show(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_AUDIENCE_LIST->value,
        ]);

        /** @var Audience $audience */
        $audience = Audience::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->getJson(
                uri: route("api.v1.admin.audience.show", $audience->id)
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'company' => [
                        'id',
                        'name',
                        'legal_name_company',
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
                        'type',
                        'status',
                        'logo',
                        'socials' => [
                            'website',
                            'facebook',
                            'instagram',
                            'youtube',
                            'tiktok',
                            'telegram',
                            'whatsapp',
                            'viber'
                        ],
                        'documents',
                        'tariff',
                        'domain',
                        'domain_updated_at',
                        'subscribers',
                        'percentage_of_filling',
                    ],
                    'country' => ['id', 'name', 'code'],
                    'region' => ['id', 'name'],
                    'gender',
                    'age' => ['min', 'max']
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $audience->id)
                    ->etc()
            );
    }

    public function test_update(): void
    {
        /**
         * @var User $user
         * @var Audience $audience
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_AUDIENCE_LIST->value,
            Permission::UPDATE_AUDIENCE->value
        ]);

        $audience = Audience::query()->inRandomOrder()->first();

        $data = Audience::factory()->raw();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->putJson(
                uri: route("api.v1.admin.audience.update", $audience->id),
                data: $data
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'company' => [
                        'id',
                        'name',
                        'legal_name_company',
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
                        'type',
                        'status',
                        'logo',
                        'socials' => [
                            'website',
                            'facebook',
                            'instagram',
                            'youtube',
                            'tiktok',
                            'telegram',
                            'whatsapp',
                            'viber'
                        ],
                        'documents',
                        'tariff',
                        'domain',
                        'domain_updated_at',
                        'subscribers',
                        'percentage_of_filling',
                    ],
                    'country' => ['id', 'name', 'code'],
                    'region' => ['id', 'name'],
                    'gender',
                    'age' => ['min', 'max']
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $audience->id)
                    ->etc()
            );

        $this->assertDatabaseHas('audiences', [
            'id' => $audience->id,
            'name->ru' => $data['name']['ru'],
            'name->en' => $data['name']['en'],
            'name->hy' => $data['name']['hy'],
            'gender' => $data['gender'],
            'age->min' => $data['age']['min'],
            'age->max' => $data['age']['max'],
            'region_id' => $data['region_id'],
            'country_id' => $data['country_id'],
            'company_id' => $data['company_id'],
        ]);
    }

    public function test_destroy(): void
    {
        /**
         * @var User $user
         * @var Audience $audience
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_AUDIENCE_LIST->value,
            Permission::DELETE_AUDIENCE->value
        ]);

        $audience = Audience::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->deleteJson(
                uri: route("api.v1.admin.audience.destroy", $audience->id)
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message'
            ]);

        $this->assertSoftDeleted('audiences', [
            'id' => $audience->id
        ]);
    }
}
