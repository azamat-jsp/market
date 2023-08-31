<?php

namespace Tests\Feature\V1\Client\Gallery;

use App\Tbuy\Company\Enums\Permission as CompanyPermission;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Gallery\Enums\GalleryType;
use App\Tbuy\Gallery\Enums\Permission;
use App\Tbuy\Gallery\Model\Gallery;
use App\Tbuy\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GalleryControllerTest extends TestCase
{
    public function test_successfully_get_list(): void
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_COMPANY_GALLERIES->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()
            ->inRandomOrder()
            ->whereHas('galleries', fn(Builder $builder) => $builder->where('type', GalleryType::PHOTO->value))
            ->value('id');

        $galleries_count = Gallery::query()
            ->where('company_id', $company_id)
            ->where('type', GalleryType::PHOTO->value)
            ->count();

        $this->actingAs($user)
            ->getJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.index',
                    parameters: ['company' => $company_id]
                )
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'src',
                        'name'
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->has('data', $galleries_count)
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_successfully_get_list_filter_photo(): void
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_COMPANY_GALLERIES->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $type = GalleryType::PHOTO->value;
        $company_id = Company::query()
            ->whereHas('galleries', fn(Builder $builder) => $builder->where('type', $type))
            ->value('id');

        $galleries_count = Gallery::query()
            ->where('company_id', $company_id)
            ->where('type', $type)
            ->count();

        $this->actingAs($user)
            ->getJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.index',
                    parameters: ['company' => $company_id, 'type' => $type]
                )
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    [
                        'id',
                        'src',
                        'name'
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->has('data', $galleries_count)
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_successfully_get_list_filter_video(): void
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_COMPANY_GALLERIES->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $type = GalleryType::VIDEO->value;
        $company_id = Company::query()
            ->whereHas('galleries', fn(Builder $builder) => $builder->where('type', $type))
            ->value('id');

        $galleries_count = Gallery::query()
            ->where('company_id', $company_id)
            ->where('type', $type)
            ->count();

        $this->actingAs($user)
            ->getJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.index',
                    parameters: ['company' => $company_id, 'type' => $type]
                )
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    [
                        'id',
                        'src',
                        'name'
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->has('data', $galleries_count)
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_successfully_get_list_wrong_filter(): void
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_COMPANY_GALLERIES->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $type = GalleryType::PHOTO->value;
        $company_id = Company::query()
            ->whereHas('galleries', fn(Builder $builder) => $builder->where('type', $type))
            ->value('id');

        $galleries_count = Gallery::query()
            ->where('company_id', $company_id)
            ->where('type', $type)
            ->count();

        $this->actingAs($user)
            ->getJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.index',
                    parameters: ['company' => $company_id, 'type' => 'invalid']
                )
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    [
                        'id',
                        'src',
                        'name'
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->has('data', $galleries_count)
                    ->etc()
            );
    }

    public function test_successfully_create_photo()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::CREATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $payload = [
            'photo' => UploadedFile::fake()->create('photo.jpg', 2 * 1024)
        ];

        $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.store',
                    parameters: ['company' => $company_id]
                ),
                data: $payload
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'src',
                    'name'
                ]
            ]);
    }

    public function test_successfully_create_video()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::CREATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $payload = [
            'video' => UploadedFile::fake()->create('video.mp4', 20 * 1024)
        ];

        $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.store',
                    parameters: ['company' => $company_id]
                ),
                data: $payload
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'src',
                    'name'
                ]
            ]);
    }

    public function test_fail_create_large_photo()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::CREATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $payload = [
            'photo' => UploadedFile::fake()->create('photo.jpg', 2.1 * 1024)
        ];

        $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.store',
                    parameters: ['company' => $company_id]
                ),
                data: $payload
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'photo',
                ]
            ]);
    }

    public function test_fail_create_large_video()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::CREATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $payload = [
            'video' => UploadedFile::fake()->create('video.mp4', 20.1 * 1024)
        ];

        $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.store',
                    parameters: ['company' => $company_id]
                ),
                data: $payload
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'video'
                ]
            ]);
    }

    public function test_successfully_update_photo()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::UPDATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $gallery_id = Gallery::query()->where('company_id', '=', $company_id)->value('id');


        $payload = [
            'photo' => UploadedFile::fake()->create('photo.jpg', 2 * 1024)
        ];

        $this->actingAs($user)
            ->putJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.update',
                    parameters: ['company' => $company_id, 'gallery' => $gallery_id]
                ),
                data: $payload
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'src',
                    'name'
                ]
            ]);
    }

    public function test_successfully_update_video()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::UPDATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $gallery_id = Gallery::query()->where('company_id', '=', $company_id)->value('id');

        $payload = [
            'video' => UploadedFile::fake()->create('video.mp4', 20 * 1024)
        ];

        $this->actingAs($user)
            ->putJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.update',
                    parameters: ['company' => $company_id, 'gallery' => $gallery_id]
                ),
                data: $payload
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'src',
                    'name'
                ]
            ]);
    }

    public function test_fail_update_large_photo()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::UPDATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $gallery_id = Gallery::query()->where('company_id', '=', $company_id)->value('id');

        $payload = [
            'photo' => UploadedFile::fake()->create('photo.jpg', 2.1 * 1024)
        ];

        $this->actingAs($user)
            ->putJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.update',
                    parameters: ['company' => $company_id, 'gallery' => $gallery_id]
                ),
                data: $payload
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'photo',
                ]
            ]);
    }

    public function test_fail_update_large_video()
    {
        /**
         * @var User $user
         * @var int $company_id
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::UPDATE_COMPANY_GALLERY->value,
            CompanyPermission::VIEW_COMPANY->value
        ]);

        $company_id = Company::query()->value('id');
        $gallery_id = Gallery::query()->where('company_id', '=', $company_id)->value('id');

        $payload = [
            'video' => UploadedFile::fake()->create('video.mp4', 20.1 * 1024)
        ];

        $this->actingAs($user)
            ->putJson(
                uri: route(
                    name: 'api.v1.client.company.gallery.update',
                    parameters: ['company' => $company_id, 'gallery' => $gallery_id]
                ),
                data: $payload
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'video'
                ]
            ]);
    }
}
