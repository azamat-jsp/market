<?php

namespace Tests\Feature\V1\Client\Invite;

use App\Tbuy\Invite\DTOs\InviteDTO;
use App\Tbuy\Invite\Enums\Permission;
use App\Tbuy\Invite\Events\InviteActivatedEvent;
use App\Tbuy\Invite\Listeners\EmployeeCreate;
use App\Tbuy\Invite\Listeners\UserCreate;
use App\Tbuy\Invite\Models\Invite;
use App\Tbuy\Invite\Notifications\InviteTokenCreated;
use App\Tbuy\Invite\Repositories\InviteRepository;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class InviteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_success_create_invite_and_send_token_to_email(): void
    {
        Notification::fake();

        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::INVITE_CREATE->value);

        $data = Invite::factory()->raw();

        $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.client.invite.store'),
                data: $data
            )
            ->assertCreated()
            ->assertJsonStructure([
                "success",
                "message"
            ])
            ->assertJson([
                'success' => true,
                'message' => 'Token created'
            ]);

        $invite = Invite::query()
            ->where('company_id', $data['company_id'])
            ->latest()
            ->first();

        Notification::assertSentTo($invite, InviteTokenCreated::class);
    }

    public function test_fail_validation()
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo([Permission::INVITE_CREATE->value]);

        $data = [
            'email' => 'admin@mail.com',
            'username' => 'some-username',
            'expired_at' => '2024-01-04'
        ];

        $this->actingAs($user)->postJson(route('api.v1.client.invite.store'), $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "company_id"
                ]
            ]);
    }

    public function test_success_activate_token()
    {
        Event::fake();

        /** @var InviteRepository $inviteRepository */
        $inviteRepository = $this->app->make(InviteRepository::class);

        $inviteData = Invite::factory()->make()->only(['company_id', 'email', 'username', 'token']);

        $invite = $inviteRepository->create(new InviteDTO(...$inviteData));

        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::INVITE_ACTIVATE->value);

        $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.client.invite.activate',
                    parameters: [
                        'token' => $invite->token,
                        'password' => '12345678',
                        'password_confirmation' => '12345678',
                    ]))
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message"
            ])
            ->assertJson([
                'success' => true,
                'message' => 'Token activated'
            ]);

        Event::assertDispatched(InviteActivatedEvent::class,
            fn(InviteActivatedEvent $event) => $event->invite->id === $invite->id && $event->password
        );
        Event::assertListening(InviteActivatedEvent::class, UserCreate::class);
        Event::assertListening(InviteActivatedEvent::class, EmployeeCreate::class);

        /** @var Invite $invite */
        $invite = Invite::query()->find($invite->id);

        $this->assertNotNull($invite->activated_at);
    }

    public function test_activate_fail_validation()
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::INVITE_ACTIVATE->value);

        $this->actingAs($user)
            ->postJson(route('api.v1.client.invite.activate'))
            ->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "token",
                    "password"
                ]
            ]);
    }
}
