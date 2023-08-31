<?php

namespace Tests\Feature\V1\Admin\Product;

use App\Enums\MorphType;
use App\Tbuy\Attributable\DTOs\AttributableDTO;
use App\Tbuy\Attributable\Models\Attributable;
use App\Tbuy\Attribute\Models\Attribute;
use App\Tbuy\Product\Enums\Permission;
use App\Tbuy\Product\Enums\ProductStatus;
use App\Tbuy\Product\Models\Product;
use App\Tbuy\Reason\Models\Reason;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Repositories\UserRepository;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::STORE_PRODUCT->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $data = Product::factory()->raw([
            'visible_fields' => ['name', 'description']
        ]);

        $this->actingAs($user)
            ->post(
                route('api.v1.admin.product.store'),
                $data
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'name_extended',
                    'description',
                    'amount',
                    'type',
                    'active',
                    'color',
                    'size',
                    'status',
                    'price',
                    'update_count',
                    'brand',
                    'category',
                    'images',
                    'accepted_at',
                    'created_at',
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'brand_id' => $product->brand_id
        ]);
    }

    public function test_successfully_update(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->syncPermissions([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::UPDATE_PRODUCT->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $data = Product::factory()->raw([
            'visible_fields' => ['name', 'description']
        ]);

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.admin.product.update', ['product' => $product->id]),
                $data
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'name_extended',
                    'description',
                    'amount',
                    'type',
                    'active',
                    'color',
                    'size',
                    'status',
                    'price',
                    'update_count',
                    'brand',
                    'category',
                    'images',
                    'attributes',
                    'accepted_at',
                    'created_at',
                    'rejections'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $product->id)
                    ->etc()
            );

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id']
        ]);
    }

    public function test_fail_update_with_empty_payload(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->syncPermissions([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::UPDATE_PRODUCT->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $data = [];

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.admin.product.update', ['product' => $product->id]),
                $data
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'category_id',
                    'amount',
                    'price',
                    'type',
                    'description.ru',
                    'description.en',
                    'description.hy',
                    'visible_fields'
                ]
            ]);
    }

    public function test_set_attribute(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->syncPermissions([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::SET_PRODUCT_ATTRIBUTE->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $attributes = Attribute::query()
            ->inRandomOrder()
            ->with('values')
            ->whereHas('values')
            ->limit(4)
            ->get()
            ->map(
                fn(Attribute $attribute) => [
                    'id' => $attribute->id,
                    'value' => $attribute->values->random(1)->first()->id,
                    'is_name_part' => false
                ]
            );
        $data = [
            'attribute' => $attributes->toArray()
        ];

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->patch(
                route('api.v1.admin.product.set_attribute', ['product' => $product->id]),
                $data
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'name_extended',
                    'description',
                    'amount',
                    'type',
                    'active',
                    'color',
                    'size',
                    'status',
                    'price',
                    'update_count',
                    'brand',
                    'category',
                    'images',
                    'attributes',
                    'accepted_at',
                    'created_at',
                    'rejections'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $product->id)
                    ->etc()
            );
    }

    public function test_fail_set_attribute(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->syncPermissions([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::SET_PRODUCT_ATTRIBUTE->value
        ]);

        $product = Product::query()->inRandomOrder()->first();

        $data = [];

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->patchJson(
                route('api.v1.admin.product.set_attribute', ['product' => $product->id]),
                $data
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'attribute'
                ]
            ]);
    }

    public function test_extend_name(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::EXTEND_PRODUCT_NAME->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $attributes = Attributable::query()
            ->inRandomOrder()
            ->limit(3)
            ->where('attributable_type', '=', MorphType::getType(Product::class))
            ->where('attributable_id', '=', $product->id)
            ->get('attribute_id')
            ->pluck('attribute_id')
            ->map(
                fn(int $id) => [
                    'attribute_id' => $id,
                    'is_name_part' => (bool)mt_rand(0, 1)
                ]
            );
        $data = [
            'attributes' => $attributes->toArray()
        ];

        $this->actingAs($user)
            ->patch(
                route('api.v1.admin.product.extend_name', ['product' => $product->id]),
                $data
            )
            ->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'name_extended',
                    'description',
                    'amount',
                    'type',
                    'active',
                    'color',
                    'size',
                    'status',
                    'price',
                    'update_count',
                    'brand',
                    'category',
                    'images',
                    'attributes',
                    'accepted_at',
                    'created_at',
                    'rejections',
                    'visible_fields',
                    'company'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $product->id)
                    ->etc()
            );
    }

    public function test_toggle_status(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->syncPermissions([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::TOGGLE_PRODUCT_STATUS->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $data = [
            'status' => ProductStatus::CONFIRMED->value
        ];

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->patch(
                route('api.v1.admin.product.toggle-status', ['product' => $product->id]),
                $data
            )
            ->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'name_extended',
                    'description',
                    'amount',
                    'type',
                    'active',
                    'color',
                    'size',
                    'status',
                    'price',
                    'update_count',
                    'brand',
                    'category',
                    'images',
                    'attributes',
                    'accepted_at',
                    'created_at',
                    'rejections'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $product->id)
                    ->where('data.status', $data['status'])
                    ->etc()
            );

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'status' => $data['status']
        ]);
    }

    public function test_toggle_status_with_reason(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->syncPermissions([
            Permission::VIEW_PRODUCT_LIST->value,
            Permission::TOGGLE_PRODUCT_STATUS->value
        ]);

        $product = Product::query()->inRandomOrder()->first();
        $data = [
            'status' => ProductStatus::CONFIRMED->value,
            'reason_id' => Reason::query()->inRandomOrder()->first()->id
        ];

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->patch(
                route('api.v1.admin.product.toggle-status', ['product' => $product->id]),
                $data
            )
            ->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'name_extended',
                    'description',
                    'amount',
                    'type',
                    'active',
                    'color',
                    'size',
                    'status',
                    'price',
                    'update_count',
                    'brand',
                    'category',
                    'images',
                    'attributes',
                    'accepted_at',
                    'created_at',
                    'rejections'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $product->id)
                    ->where('data.status', $data['status'])
                    ->etc()
            );

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'status' => $data['status']
        ]);
    }
}
