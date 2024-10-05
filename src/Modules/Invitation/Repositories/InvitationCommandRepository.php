<?php

namespace Modules\Invitation\Repositories;

use Modules\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;
use Modules\Invitation\Dto\InvitationCreateDto;
use Modules\Invitation\Dto\InvitationUpdateDto;
use Infrastructure\Eloquent\Models\Invitation;

class InvitationCommandRepository implements InvitationCommandRepositoryInterface
{
    public function create(InvitationCreateDto $dto): Invitation
    {
        return Invitation::create([
            'event_id' => $dto->eventId,
            'user_id' => $dto->userId,
            'recipient_contact' => $dto->recipientContact,
            'channel' => $dto->channel,
            'message' => $dto->message,
            'invitation_link' => $dto->invitationLink,
            'status' => $dto->status,
        ]);
    }

    public function update(InvitationUpdateDto $dto): Invitation
    {
        $invitation = Invitation::findOrFail($dto->id);
        $invitation->update([
            'recipient_contact' => $dto->recipientContact,
            'channel' => $dto->channel,
            'message' => $dto->message,
            'invitation_link' => $dto->invitationLink,
            'status' => $dto->status,
        ]);

        return $invitation;
    }

    public function delete(int $invitationId): void
    {
        Invitation::findOrFail($invitationId)->delete();
    }
}