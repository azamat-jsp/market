<?php

namespace Tests\Feature\V1\Admin\Rejection;

use App\Enums\MorphType;
use App\Tbuy\Reason\Models\Reason;
use App\Tbuy\Rejection\Enums\Permission;
use App\Tbuy\Rejection\Models\Rejection;
use App\Tbuy\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RejectionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::VIEW_REJECTIONS->value);
        $parameters = ['type' => MorphType::BRAND->value];
        $perPage = 15;

        $this->actingAs($user)
            ->getJson(route('api.v1.admin.rejection.index', $parameters))
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    [
                        "id",
                        "user",
                        "target",
                        "reason",
                        "image",
                        "created_at"
                    ]
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('success', true)->has('data', $perPage)->etc()
            );
    }

    public function test_update(): void
    {
        /**
         * @var User $user
         * @var Reason $reason
         * @var Rejection $rejection
         */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::UPDATE_REJECTION->value);
        $rejection = Rejection::query()->inRandomOrder()->first();
        $reason = Reason::query()->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->putJson(route('api.v1.admin.rejection.update', $rejection->id), ['reason_id' => $reason->id])
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "user",
                    "target",
                    "reason",
                    "image",
                    "created_at"
                ]
            ])->assertJson(
                fn(AssertableJson $json) => $json->where('success', true)->etc()
            );

        $this->assertEquals($reason->id, $response->json('data.reason.id'));
    }
}
