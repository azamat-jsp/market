<?php

namespace Tests\Feature\V1\Admin\Search;


use App\Tbuy\ModelInfo\Models\ModelField;
use App\Tbuy\Search\Enums\Permission;
use App\Tbuy\Search\Model\SearchableField;
use App\Tbuy\Search\Model\SearchableModel;
use App\Tbuy\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SearchableFieldTest extends TestCase
{
    public function test_successfully_index(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::VIEW_SEARCHABLE_FIELD->value);

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->getJson(route('api.v1.admin.search_field.index'))
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    [
                        "id",
                        "model_field" => [
                            "id",
                            "name",
                            "slug"
                        ],
                        "searchable_model" => [
                            "id",
                            "priority",
                            "count"
                        ],
                        "priority"
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('success', true)->etc()
            );
    }

    public function test_successfully_show(): void
    {
        /** @var User $user */
        /** @var SearchableField $searchableField */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::SHOW_SEARCHABLE_FIELD->value);

        $searchableField = SearchableField::query()
            ->whereHas('searchableModel', fn(Builder $builder) => $builder->whereNull('deleted_at'))
            ->inRandomOrder()
            ->first();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->getJson(route('api.v1.admin.search_field.show', $searchableField->id))
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "model_field" => [
                        "id",
                        "name",
                        "slug"
                    ],
                    "searchable_model" => [
                        "id",
                        "priority",
                        "count"
                    ],
                    "priority"
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $searchableField->id)
                    ->etc()
            );
    }

    public function test_successfully_update(): void
    {
        /**
         * @var User $user
         * @var SearchableField $searchableField
         * @var ModelField $modelField
         * @var SearchableModel $searchableModel
         */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::UPDATE_SEARCHABLE_FIELD->value);

        $searchableField = SearchableField::query()->inRandomOrder()->first()->load(['modelField', 'searchableModel']);

        $modelField = $searchableField->modelField;
        $searchableModel = $searchableField->searchableModel;

        $data = [
            'priority' => 1,
            'is_enabled' => 0,
        ];
        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->putJson(route('api.v1.admin.search_field.update', $searchableField->id), $data)
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "model_field" => [
                        "id",
                        "name",
                        "slug"
                    ],
                    "searchable_model" => [
                        "id",
                        "priority",
                        "count"
                    ],
                    "priority"
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $searchableField->id)
                    ->where('data.model_field.id', $modelField->id)
                    ->where('data.searchable_model.id', $searchableModel->id)
                    ->etc()
            );

        $this->assertDatabaseHas('searchable_fields', ['id' => $searchableField->id] + $data);
    }

    public function test_error_update_with_empty_data(): void
    {
        /**
         * @var User $user
         * @var SearchableField $searchableField
         */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::UPDATE_SEARCHABLE_FIELD->value);

        $searchableField = SearchableField::query()->inRandomOrder()->first();

        $data = [];
        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->putJson(route('api.v1.admin.search_field.update', $searchableField->id), $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors" => [
                    'priority',
                ]
            ]);
    }

    public function test_successfully_destroy(): void
    {
        /**
         * @var User $user
         * @var SearchableField $searchableField
         */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::DELETE_SEARCHABLE_FIELD->value);

        $searchableField = SearchableField::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->deleteJson(route('api.v1.admin.search_field.destroy', $searchableField->id))
            ->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "message"
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('success', true)->etc()
            );

        $this->assertSoftDeleted('searchable_fields', [
            'id' => $searchableField->id
        ]);
    }
}
