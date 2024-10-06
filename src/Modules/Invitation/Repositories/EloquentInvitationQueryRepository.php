<?php

namespace Modules\Invitation\Repositories;

use Modules\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Invitation\Dto\InvitationViewRequestDto;
use Modules\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\Invitation;

class EloquentInvitationQueryRepository implements InvitationQueryRepositoryInterface
{
    public function view(InvitationViewRequestDto $dto): Invitation
    {
        return Invitation::findOrFail($dto->id);
    }

    public function query(InvitationQueryRequestDto $dto): array
    {
        return Invitation::where('event_id', $dto->eventId)->get()->toArray();
    }
}
