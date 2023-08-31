<?php

namespace Tests\Feature\V1\Client\Company;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Filial\Enums\Permission as FilialPermission;
use App\Tbuy\Filial\Models\Filial;
use App\Tbuy\Company\Enums\Permission;
use App\Tbuy\User\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use WithFaker;

    public function test_success_store()
    {
        $companyPayload = Company::factory()
            ->raw([
                'name' => $this->faker->word() . " - name",
                'phones' => ['phone_director' => $this->faker->phoneNumber],
                'brand_document' => UploadedFile::fake()->create('fake_brand_document.pdf', 1024),
                'passport_document' => UploadedFile::fake()->create('fake_passport_document.pdf', 1024),
                'state_register_document' => UploadedFile::fake()->create('fake_state_register_document.pdf', 1024),
                'identity_images' => [
                    ['name' => 'abdc.jpg', 'file' => UploadedFile::fake()->create('abdc.jpg', 1024)],
                    ['name' => 'abcdc.jpg', 'file' => UploadedFile::fake()->create('abcdc.jpg', 1024)],
                ],
            ]);

        $this->postJson(
            uri: route('api.v1.client.company.register'),
            data: $companyPayload
        )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
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
                    'legal_entity',
                    'status',
                    'socials' => [
                        'website',
                        'facebook',
                        'instagram',
                        'youtube',
                        'tiktok',
                        'telegram'
                    ],
                    'documents' => [
                        'brand',
                        'passport',
                        'state_register'
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('data.name', $companyPayload['name'])
                    ->etc()
            );
    }

    public function test_store_with_authorized_user()
    {
        /** @var User $user */
        $user = User::query()->first();

        $companyPayload = Company::factory()->raw([
            'phones' => ['phone_director' => (string)mt_rand(10000000, 99999999)],
            'brand_document' => UploadedFile::fake()->create('fake_brand_document.pdf', 1024),
            'passport_document' => UploadedFile::fake()->create('fake_passport_document.pdf', 1024),
            'state_register_document' => UploadedFile::fake()->create('fake_state_register_document.pdf', 1024),
            'identity_images' => [
                ['name' => 'abdc.jpg', 'file' => UploadedFile::fake()->create('abdc.jpg', 1024)],
                ['name' => 'abcdc.jpg', 'file' => UploadedFile::fake()->create('abcdc.jpg', 1024)],
            ],
        ]);

        $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->postJson(
                uri: route('api.v1.client.company.register'),
                data: $companyPayload
            )
            ->assertBadRequest();
    }

    public function test_successfully_score()
    {
        /**
         * @var User $user
         * @var Company $company
         */
        $user = User::query()->first();
        $company = Company::query()->inRandomOrder()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            Permission::SCORE_COMPANY->value,
        ]);

        $response = $this->actingAs($user)
            ->patchJson(
                uri: route('api.v1.client.company.score', $company->id),
                data: [
                    'score' => 3
                ]
            )->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
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
                    'legal_entity',
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
                    'average_rating_score'
                ]
            ])->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $company->id)
                    ->etc()
            )->json('data');

        $this->assertDatabaseHas('company_rating', [
            'company_id' => $company->id,
            'user_id' => $user->id,
            'rating' => 3
        ]);

        $average_score = $company->load('ratings')->ratings->avg(
            fn(User $user) => $user->pivot->rating
        );

        $this->assertEquals($average_score, $response['average_rating_score']);
    }

    public function test_successfully_remove_score()
    {
        /**
         * @var User $user
         * @var Company $company
         */
        $user = User::query()->first();
        $company = Company::query()->inRandomOrder()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            Permission::SCORE_COMPANY->value,
        ]);

        $response = $this->actingAs($user)
            ->patchJson(
                uri: route('api.v1.client.company.score', $company->id)
            )->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
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
                    'legal_entity',
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
                    'average_rating_score'
                ]
            ])->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $company->id)
                    ->etc()
            )->json('data');

        $this->assertDatabaseMissing('company_rating', [
            'company_id' => $company->id,
            'user_id' => $user->id,
        ]);

        $average_score = $company->load('ratings')->ratings->avg(
            fn(User $user) => $user->pivot->rating
        );

        $this->assertEquals($average_score, $response['average_rating_score']);
    }

    public function test_fail_validation_error_with_greater_score()
    {
        /**
         * @var User $user
         * @var Company $company
         */
        $user = User::query()->first();
        $company = Company::query()->inRandomOrder()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            Permission::SCORE_COMPANY->value,
        ]);

        $this->actingAs($user)
            ->patchJson(
                uri: route('api.v1.client.company.score', $company->id),
                data: [
                    'score' => 6
                ]
            )->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'score'
                ]
            ]);
    }

    public function test_fail_validation_error_with_lower_score()
    {
        /**
         * @var User $user
         * @var Company $company
         */
        $user = User::query()->first();
        $company = Company::query()->inRandomOrder()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            Permission::SCORE_COMPANY->value,
        ]);

        $this->actingAs($user)
            ->patchJson(
                uri: route('api.v1.client.company.score', $company->id),
                data: [
                    'score' => 0
                ]
            )->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'score'
                ]
            ]);
    }

    public function test_update_company()
    {
        /** @var User $user */
        $user = User::query()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            Permission::UPDATE_COMPANY->value,
        ]);

        /* @var Company $company */
        $company = Company::query()->inRandomOrder()->first();

        $requestData = Company::factory()->raw([
            'brand_document' => UploadedFile::fake()->create('fake_brand_document.pdf', 1024),
            'inn_document' => UploadedFile::fake()->create('fake_inn_document.pdf', 1024),
            'passport_document' => UploadedFile::fake()->create('fake_passport_document.pdf', 1024),
            'state_register_document' => UploadedFile::fake()->create('fake_state_register_document.pdf', 1024),
            'parent_id' => null,
            'identity_images' => [
                [
                    'file' => UploadedFile::fake()->create('fake_identity_1.jpg', 1024),
                    'name' => 'fake-identity-1.jpg'
                ],
                [
                    'file' => UploadedFile::fake()->create('fake_identity_2.jpg', 1024),
                    'name' => 'fake-identity-2.jpg'
                ]
            ]
        ]);

        $this->actingAs($user)
            ->putJson(
                uri: route('api.v1.client.company.update', ['company' => $company->id]),
                data: $requestData,
            )->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
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
                    'legal_entity',
                    'type',
                    'status',
                    'documents' => [
                    ],
                    'tariff'
                ]
            ]);
    }

    public function test_store_filing_company()
    {
        /** @var User $user */
        $user = User::query()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            FilialPermission::VIEW_COMPANY_FILIAL->value,
            FilialPermission::CREATE_COMPANY_FILIAL->value,
        ]);

        /* @var Company $company */
        $company = Company::query()
            ->inRandomOrder()
            ->whereHas('filials')
            ->first();

        $requestData = Filial::factory()->raw();

        $this->actingAs($user)
            ->postJson(
                route('api.v1.client.company.filial.store', ['company' => $company->id]),
                $requestData
            )->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'phone',
                    'address',
                    'coordinates' => [
                        'latitude',
                        'longitude'
                    ],
                    'schedule' => [
                        [
                            'open_at',
                            'close_at',
                            'day',
                            'day_string'
                        ]
                    ],
                    'is_main',
                    'community' => [
                        'id'
                    ],
                    'region' => [
                        'id'
                    ]
                ]
            ])->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_update_filing_company()
    {
        /** @var User $user */
        $user = User::query()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            FilialPermission::VIEW_COMPANY_FILIAL->value,
            FilialPermission::UPDATE_COMPANY_FILIAL->value
        ]);

        /* @var Company $company */
        $company = Company::query()
            ->inRandomOrder()
            ->with('filials')
            ->whereHas('filials')
            ->first();

        $filial_id = $company->filials->random(1)->first()->id;

        $requestData = Filial::factory()->raw();

        $this->actingAs($user)
            ->putJson(
                route('api.v1.client.company.filial.update', [$company->id, $filial_id]),
                $requestData
            )->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'phone',
                    'address',
                    'coordinates' => [
                        'latitude',
                        'longitude'
                    ],
                    'schedule' => [
                        [
                            'open_at',
                            'close_at',
                            'day',
                            'day_string'
                        ]
                    ],
                    'is_main',
                    'community' => [
                        'id'
                    ],
                    'region' => [
                        'id'
                    ]
                ]
            ])->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $filial_id)
                    ->etc()
            );
    }

    public function test_update_wrong()
    {
        /** @var User $user */
        $user = User::query()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            FilialPermission::VIEW_COMPANY_FILIAL->value,
            FilialPermission::UPDATE_COMPANY_FILIAL->value,
        ]);

        /* @var Company $company */
        $company = Company::query()
            ->inRandomOrder()
            ->whereHas('filials')
            ->first();

        $requestData = Filial::factory()->raw();

        $filial_id = Filial::query()
            ->where('company_id', '<>', $company->id)
            ->inRandomOrder()
            ->value('id');

        $this->actingAs($user)
            ->putJson(
                uri: route('api.v1.client.company.filial.update', [$company->id, $filial_id]),
                data: $requestData
            )->assertNotFound()
            ->assertJsonStructure([
                'success',
                'message',
            ])->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', false)
                    ->where('message', 'Company not found')
                    ->etc()
            );
    }

    public function test_delete_filing_company()
    {
        /** @var User $user */
        $user = User::query()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            FilialPermission::VIEW_COMPANY_FILIAL->value,
            FilialPermission::DELETE_COMPANY_FILIAL->value,
        ]);

        /* @var Company $company */
        $company = Company::query()
            ->inRandomOrder()
            ->with('filials')
            ->whereHas('filials')
            ->first();
        $filial_id = $company->filials->random(1)->first()->id;

        $this->actingAs($user)
            ->deleteJson(
                uri: route('api.v1.client.company.filial.destroy', [$company, $filial_id])

            )->assertOk()
            ->assertJsonStructure([
                'message',
                'success'
            ])->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('message', 'Filial deleted')
                    ->etc()
            );

        $this->assertSoftDeleted('filials', [
            'id' => $filial_id
        ]);
    }

    public function test_successfully_update_company_logo()
    {
        /** @var User $user */
        $user = User::query()->first();

        $user->givePermissionTo([
            Permission::VIEW_COMPANY->value,
            Permission::UPDATE_COMPANY_LOGO->value,
        ]);

        /* @var Company $company */
        $company = Company::query()->with('logo')->inRandomOrder()->first();
        $payload['logo'] = UploadedFile::fake()->create('brand_logo.jpg');

        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.client.company.logo', ['company' => $company->id]),
                data: $payload,
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
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
                    'legal_entity',
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
                    'domain_updated_at'
                ]
            ]);
    }
}
