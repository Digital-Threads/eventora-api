<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories;

use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryQueryRepositoryInterface;

class EloquentInvitationDeliveryQueryRepository implements InvitationDeliveryQueryRepositoryInterface
{
    public function query(InvitationDeliveryQueryRequestDto $dto): array
    {
        return InvitationDelivery::where('invitation_id', $dto->invitationId)->get()->toArray();
    }

    public function view(int $id): InvitationDelivery
    {
        return InvitationDelivery::findOrFail($id);
    }
}
