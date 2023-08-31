<?php

namespace Tests\Feature\V1\Client\Resume;

use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Resume\Enums\Permission;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\User\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResumeControllerTest extends TestCase
{
    use WithFaker;

    public function test_successfully_get_favorite_resumes()
    {
        /** @var User $user $user */
        $user = User::factory()->create();
        $user->givePermissionTo([
            Permission::RESUME_FAVORITE_GET->value
        ]);

        Resume::factory(10)->create()->each(function (Resume $resume) use ($user) {
            $user->favorite($resume);
        });

        $this->actingAs($user)
            ->getJson(
                uri: route('api.v1.client.resume.getFavorite')
            )->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    [
                        'id',
                        'vacancy',
                        'category' => [
                            'id',
                            'name'
                        ],
                        'preferred_salary',
                        'experience',
                        'created_at'
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        [
                            'url',
                            'label',
                            'active'
                        ]
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ]);
    }

    public function test_successfully_get_resumes()
    {
        /** @var User $user $user */
        $user = User::factory()->create();
        $user->givePermissionTo([
            Permission::RESUME_LIST->value
        ]);

        $company = Company::query()->inRandomOrder()->has('vacancies')->first();

        $this->actingAs($user)->getJson(
            uri: route('api.v1.client.resume.index', $company->id)
        )->assertSuccessful()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    [
                        'id',
                        'vacancy',
                        'category' => [
                            'id',
                            'name'
                        ],
                        'preferred_salary',
                        'experience',
                        'created_at'
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        [
                            'url',
                            'label',
                            'active'
                        ]
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ]);
    }

    public function test_successfully_store(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::RESUME_STORE->value);

        $resume = Resume::factory()->make();

        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.client.resume.store'),
                data: $resume->toArray()
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'vacancy',
                    'preferred_salary',
                    'experience'
                ]
            ]);
    }

    public function test_successfully_guest_store(): void
    {

        $resume = Resume::factory()->make();
        $file = UploadedFile::fake()->create('simple.pdf');
        $payload = array_merge($resume->toArray(), ['file' => $file]);

        $this->postJson(
            uri: route('api.v1.client.resume.guest_store'),
            data: $payload
        )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'vacancy',
                    'category',
                    'preferred_salary',
                    'experience',
                    'file'
                ]
            ]);
    }

    public function test_successfully_favorite_resume(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::RESUME_FAVORITE_STORE->value);

        $resume_id = Resume::query()->inRandomOrder()->value('id');
        $payload = Resume::factory()->raw();

        $this->actingAs($user)->postJson(
            uri: route('api.v1.client.resume.favorite', ['resume' => $resume_id]),
            data: $payload
        )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'vacancy',
                    'preferred_salary',
                    'experience'
                ]
            ]);
    }

    public function test_store_with_invalid_data(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::RESUME_STORE->value);

        $invalidResumeData = [
            'vacancy_id' => Str::random(20),
        ];

        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.client.resume.store'),
                data: $invalidResumeData
            )
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'vacancy_id',
            ]);
    }

}
