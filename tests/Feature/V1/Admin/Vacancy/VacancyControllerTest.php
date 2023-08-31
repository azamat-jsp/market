<?php

namespace Tests\Feature\V1\Admin\Vacancy;

use App\Tbuy\Company\Enums\Permission as PermissionCompany;
use App\Tbuy\User\Models\User;
use App\Tbuy\Vacancy\Enums\Permission;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class VacancyControllerTest extends TestCase
{
    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo([
            Permission::CREATE_VACANCY->value,
            Permission::VIEW_VACANCY_LIST->value,
            PermissionCompany::VIEW_COMPANY->value
        ]);

        $data = Vacancy::factory()->raw([
            'images' => [
                [
                    'name' => 'vacancy-image.png',
                    'file' => UploadedFile::fake()->image('vacancy-image.png')
                ]
            ]
        ]);

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->postJson(route('api.v1.admin.vacancies.store'), $data)
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'salary',
                    'status',
                    'address',
                    'position',
                    'working_conditions',
                    'working_type',
                    'deadline',
                    'category' => [
                        'id',
                        'name'
                    ],
                    'images'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_successfully_update(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo([
            Permission::UPDATE_VACANCY->value,
            Permission::VIEW_VACANCY_LIST->value,
            PermissionCompany::VIEW_COMPANY->value
        ]);

        $vacancy = Vacancy::query()->inRandomOrder()->first();
        $data = Vacancy::factory()->raw([
            'images' => [
                [
                    'name' => 'vacancy-image.png',
                    'file' => UploadedFile::fake()->image('vacancy-image.png')
                ]
            ]
        ]);

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->put(
                route('api.v1.admin.vacancies.update', ['vacancy' => $vacancy->id]),
                $data
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'salary',
                    'status',
                    'address',
                    'position',
                    'working_conditions',
                    'working_type',
                    'deadline',
                    'category' => [
                        'id',
                        'name'
                    ],
                    'images'
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->where('data.id', $vacancy->id)
                    ->etc()
            );
    }

    public function test_successfully_destroy(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo([
            Permission::VIEW_VACANCY_LIST->value,
            Permission::DELETE_VACANCY->value
        ]);

        $vacancy = Vacancy::factory()->create();

        $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->delete(route('api.v1.admin.vacancies.destroy', ['vacancy' => $vacancy->id]))
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'message'
            ]);

        $this->assertSoftDeleted($vacancy->getTable(), ['id' => $vacancy->id]);
    }
}
