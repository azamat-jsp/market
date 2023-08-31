<?php

namespace Tests\Feature\V1\Admin\Category;

use App\Tbuy\Category\Enums\Permission;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\User\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use WithFaker;

    public function test_index()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::VIEW_CATEGORY->value);
        $this->actingAs($user);

        $response = $this->getJson(route('api.v1.admin.category.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'parent_id',
                        'position',
                        'is_active',
                        'min_images',
                        'form_description',
                        'offer_services',
                        'description',
                        'type',
                        'logo',
                        'icon',
                    ]
                ]
            ]);
    }

    public function test_get_child_level()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::RATIO_CATEGORY->value);

        $grandParentCategory = Category::factory()->create();
        $parentCategory = Category::factory()->create(['parent_id' => $grandParentCategory->id]);
        $childCategory = Category::factory()->create(['parent_id' => $parentCategory->id]);

        $this->actingAs($user)
            ->getJson(
                uri: route('api.v1.admin.category.ratio', ['category' => $childCategory->id])
            )
            ->assertOk()
            ->assertJson([
                'data' => [
                    'ratio' => 3
                ]
            ]);
    }
//
//    public function test_store()
//    {
//        /**
//         * @var User $user
//         */
//
//        $user = User::factory()->create();
//        $user->givePermissionTo('store category');
//
//        $categoryData = Category::factory()->raw([
//            'icon' => UploadedFile::fake()->image('icon.png', 1024, 1024),
//            'logo' => UploadedFile::fake()->image('logo.png', 1024, 1024),
//        ]);
//
//        $this->actingAs($user)
//            ->postJson(route('api.v1.admin.category.store'), $categoryData)
//            ->assertCreated()
//            ->assertJsonStructure([
//                'success',
//                'message',
//                'data' => [
//                    'id',
//                    'name',
//                    'parent_id',
//                    'position',
//                    'is_active',
//                    'min_images',
//                    'form_description',
//                    'offer_services',
//                    'description',
//                    'logo',
//                    'icon',
//                ]
//            ])->assertJson(
//                fn(AssertableJson $json) => $json
//                    ->where('success', true)
//                    ->etc()
//            );
//    }
//
//    public function test_update()
//    {
//        /**
//         * @var User $user
//         * @var Category $category
//         */
//
//        $user = User::factory()->create();
//        $user->givePermissionTo('update category');
//        $category = Category::factory()->create();
//
//        $categoryData = Category::factory()->raw([
//            'logo' => UploadedFile::fake()->image('logo.png', 1024, 1024),
//            'icon' => UploadedFile::fake()->image('icon.png', 1024, 1024),
//        ]);
//
//        $this->actingAs($user)
//            ->putJson(
//                uri: route('api.v1.admin.category.update', $category->id),
//                data: $categoryData
//            )
//            ->assertOk()
//            ->assertJsonStructure([
//                'success',
//                'message',
//                'data' => [
//                    'id',
//                    'name',
//                    'parent_id',
//                    'position',
//                    'is_active',
//                    'min_images',
//                    'form_description',
//                    'offer_services',
//                    'description',
//                    'logo',
//                    'icon',
//                ]
//            ])->assertJson(
//                fn(AssertableJson $json) => $json
//                    ->where('success', true)
//                    ->etc()
//            );
//    }

    public function test_destroy()
    {
        $user = User::factory()->create([
            'email' => $this->faker->unique()->safeEmail(),
        ]);
        $user->givePermissionTo(Permission::DELETE_CATEGORY->value);

        $category = Category::factory()->create();

        $this
            ->actingAs($user)
            ->deleteJson(route('api.v1.admin.category.destroy', ['category' => $category->id]))
            ->assertOk();

        $this->assertSoftDeleted('categories', [
            'id' => $category->id
        ]);
    }
}
