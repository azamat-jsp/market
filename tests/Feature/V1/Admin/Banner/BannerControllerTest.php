<?php

namespace Tests\Feature\V1\Admin\Banner;

use App\Tbuy\Banner\Enums\Permission;
use App\Tbuy\Banner\Models\Banner;
use App\Tbuy\User\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BannerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_successfully_get_list(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::VIEW_BANNER->value);
        $bannersCount = Banner::query()->count();

        $this->actingAs($user)
            ->getJson(route('api.v1.admin.banner.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    [
                        "id",
                        "name",
                        "content"
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->has('data', $bannersCount)
                    ->etc()
            );
    }

    public function test_successfully_detailed_view()
    {
        /**
         * @var User $user
         * @var Banner $banner
         */
        $user = User::query()->first();
        $user->givePermissionTo([Permission::VIEW_BANNER->value]);

        $banner = Banner::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->getJson(route('api.v1.admin.banner.show', $banner))
            ->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "name",
                    "content"
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('data.id', $banner->id)->etc()
            );
    }

    public function test_successfully_create_new_banner()
    {
        /**
         * @var User $user
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_BANNER->value,
            Permission::CREATE_BANNER->value
        ]);

        $banner = Banner::factory()->raw();
        $mime = fake()->randomElement(['png', 'svg', 'jpeg', 'jpg', 'psd']);


        $banner['file'] = UploadedFile::fake()->create("template-test.$mime", 1024 * 4);

        $this->actingAs($user)
            ->postJson(route('api.v1.admin.banner.store'), $banner)
            ->assertCreated()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "name",
                    "content",
                    'file',
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('data.content', $banner['content'])->etc()
            );
    }

    public function test_fail_validation_create_new_banner()
    {
        /**
         * @var User $user
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_BANNER->value,
            Permission::CREATE_BANNER->value
        ]);

        $banner = Banner::factory()->raw();
        data_forget($banner, 'name.en');

        $this->actingAs($user)
            ->postJson(route('api.v1.admin.banner.store'), $banner)
            ->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name.en"
                ]
            ]);

    }

    public function test_successfully_update_banner()
    {
        /**
         * @var User $user
         * @var Banner $banner
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_BANNER->value,
            Permission::UPDATE_BANNER->value
        ]);

        $banner = Banner::query()->inRandomOrder()->first();
        $bannerRaw = Banner::factory()->raw();
        $mime = fake()->randomElement(['png', 'svg', 'jpeg', 'jpg', 'psd']);


        $bannerRaw['file'] = UploadedFile::fake()->create("template-test.$mime", 1024 * 4);

        $this->actingAs($user)
            ->putJson(route('api.v1.admin.banner.update', $banner->id), $bannerRaw)
            ->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "name",
                    "content",
                    'file'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('success', true)
                    ->where('data.content', $bannerRaw['content'])
                    ->where('data.id', $banner->id)
                    ->etc()
            );
    }

    public function test_fail_validation_update_banner()
    {
        /**
         * @var User $user
         * @var Banner $banner
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_BANNER->value,
            Permission::UPDATE_BANNER->value
        ]);

        $banner = Banner::query()->inRandomOrder()->first();
        $bannerRaw = Banner::factory()->raw();
        data_forget($bannerRaw, 'name.en');

        $this->actingAs($user)
            ->putJson(route('api.v1.admin.banner.update', $banner->id), $bannerRaw)
            ->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name.en"
                ]
            ]);

    }

    public function test_successfully_delete_banner()
    {
        /**
         * @var User $user
         * @var Banner $banner
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_BANNER->value,
            Permission::DELETE_BANNER->value
        ]);

        $banner = Banner::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->deleteJson(route('api.v1.admin.banner.delete', $banner->id))
            ->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "message"
            ]);

        $this->assertSoftDeleted('banners', [
            'id' => $banner->id
        ]);
    }

    public function test_success_auth()
    {
        $banner = Banner::query()->first();
        $this->get(route('api.v1.admin.banner.index'), $this->headers)->assertUnauthorized();
        $this->get(route('api.v1.admin.banner.show', $banner->id), $this->headers)->assertUnauthorized();
        $this->post(route('api.v1.admin.banner.store'), [], $this->headers)->assertUnauthorized();
        $this->put(route('api.v1.admin.banner.update', $banner->id), [], $this->headers)->assertUnauthorized();
        $this->delete(route('api.v1.admin.banner.delete', $banner->id), [], $this->headers)->assertUnauthorized();
    }
}
