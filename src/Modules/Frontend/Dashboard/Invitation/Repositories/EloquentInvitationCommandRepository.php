<?php

namespace Modules\Frontend\Dashboard\Invitation\Repositories;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationUpdateRequestDto;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;

class EloquentInvitationCommandRepository implements InvitationCommandRepositoryInterface
{
    public function create(InvitationCreateRequestDto $dto): Invitation
    {
        return Invitation::create([
            'event_id' => $dto->eventId,
            'title' => $dto->title,
            'message' => $dto->message,
            'invitation_link' => $dto->invitationLink,
        ]);
    }

    public function update(InvitationUpdateRequestDto $dto): Invitation
    {
        $invitation = Invitation::findOrFail($dto->id);
        $invitation->update([
            'title' => $dto->title,
            'message' => $dto->message,
            'invitation_link' => $dto->invitationLink,
        ]);

        return $invitation;
    }
}
