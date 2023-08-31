<?php

namespace App\Tbuy\Invite\Services;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Invite\DTOs\InviteActivateDTO;
use App\Tbuy\Invite\DTOs\InviteDTO;
use App\Tbuy\Invite\Events\InviteActivatedEvent;
use App\Tbuy\Invite\Exceptions\InviteExpiredException;
use App\Tbuy\Invite\Models\Invite;
use App\Tbuy\Invite\Notifications\InviteTokenActivated;
use App\Tbuy\Invite\Notifications\InviteTokenCreated;
use App\Tbuy\Invite\Repositories\InviteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InviteServiceImplementation implements InviteService
{
    public function __construct(
        private readonly InviteRepository $inviteRepository
    )
    {
    }

    public function createAndSendNotification(InviteDTO $payload): Invite
    {
        $payload->token = hash_hmac('sha256', Str::random(40), '');

        $username = Company::where('id', $payload->company_id)->value('name'). '_' . $payload->username;

        $invite = $this->inviteRepository->create(new InviteDTO(
            $payload->company_id,
            $payload->email,
            $username,
            $payload->token
        ));

        $invite->notify(new InviteTokenCreated($payload->token, $payload->company_id));

        return $invite;
    }

    /**
     * @throws ModelNotFoundException|InviteExpiredException
     */
    public function activateByToken(InviteActivateDTO $dto): Invite
    {
        $invite = $this->inviteRepository->findInviteByToken($dto->token);

        if (!$invite) {
            throw new ModelNotFoundException("Приглашение не найдено");
        }

        if ($invite->is_expired) {
            throw new InviteExpiredException("Приглашение просрочено");
        }

        $password = $dto->password;

        $invite = DB::transaction(function () use ($invite, $password) {

            InviteActivatedEvent::dispatch($invite, $password);

            return $this->inviteRepository->activate($invite);
        });

        $invite->notify(new InviteTokenActivated($password));

        return $invite;
    }
}
