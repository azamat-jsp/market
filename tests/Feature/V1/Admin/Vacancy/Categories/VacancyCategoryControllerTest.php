<?php

namespace Tests\Feature\V1\Admin\Vacancy\Categories;

use App\Tbuy\User\Models\User;
use App\Tbuy\User\Repositories\UserRepository;
use App\Tbuy\Vacancy\Enums\Permission;
use App\Tbuy\Vacancy\Models\VacancyCategory;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class VacancyCategoryControllerTest extends TestCase
{
    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_VACANCY_CATEGORY_LIST->value,
            Permission::CREATE_VACANCY_CATEGORY->value,
        ]);

        $data = VacancyCategory::factory()->raw();

        $vacancy_id = $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->post(route('api.v1.admin.vacancies.categories.store'), $data)
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            )->json('data.id');

        $this->assertDatabaseHas('vacancy_categories', [
            'id' => $vacancy_id,
            'name->ru' => $data['name']['ru'],
            'name->en' => $data['name']['en'],
            'name->hy' => $data['name']['hy']
        ]);
    }

    public function test_successfully_update(): void
    {
        /**
         * @var User $user
         * @var VacancyCategory $vacancyCategory
         */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_VACANCY_CATEGORY_LIST->value,
            Permission::UPDATE_VACANCY_CATEGORY->value,
        ]);

        $vacancyCategory = VacancyCategory::query()->inRandomOrder()->first();
        $data = VacancyCategory::factory()->raw();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.admin.vacancies.categories.update', ['category' => $vacancyCategory->id]),
                $data
            )
            ->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $vacancyCategory->id)
                    ->etc()
            );

        $this->assertDatabaseHas('vacancy_categories', [
            'id' => $vacancyCategory->id,
            'name->ru' => $data['name']['ru'],
            'name->en' => $data['name']['en'],
            'name->hy' => $data['name']['hy']
        ]);
    }

    public function test_successfully_destroy(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([
            Permission::VIEW_VACANCY_CATEGORY_LIST->value,
            Permission::DELETE_VACANCY_CATEGORY->value,
        ]);

        $vacancyCategory = VacancyCategory::factory()->create();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->delete(route('api.v1.admin.vacancies.categories.destroy', ['category' => $vacancyCategory->id]))
            ->assertSuccessful()
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
}
