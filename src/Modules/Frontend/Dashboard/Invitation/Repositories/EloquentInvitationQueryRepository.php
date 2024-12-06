<?php

namespace Modules\Frontend\Dashboard\Invitation\Repositories;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationViewRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;

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
