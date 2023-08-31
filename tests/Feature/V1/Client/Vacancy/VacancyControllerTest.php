<?php

namespace Tests\Feature\V1\Client\Vacancy;

use App\Tbuy\Company\Enums\Permission;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\User\Models\User;
use App\Tbuy\Vacancy\Enums\Permission as PermissionVacancy;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class VacancyControllerTest extends TestCase
{
    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo([
            PermissionVacancy::CREATE_VACANCY->value,
            PermissionVacancy::VIEW_VACANCY_LIST->value,
            Permission::VIEW_COMPANY->value
        ]);

        $company = Company::query()->inRandomOrder()->first();
        $data = Vacancy::factory()->raw();

        $this->actingAs($user)
            ->postJson(route('api.v1.client.company.vacancy.store', $company->id), $data)
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
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
    }
}
