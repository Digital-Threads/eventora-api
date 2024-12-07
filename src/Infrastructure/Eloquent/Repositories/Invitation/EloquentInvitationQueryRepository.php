<?php

namespace Infrastructure\Eloquent\Repositories\Invitation;

use Domain\Invitation\Repositories\InvitationQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationViewRequestDto;

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
