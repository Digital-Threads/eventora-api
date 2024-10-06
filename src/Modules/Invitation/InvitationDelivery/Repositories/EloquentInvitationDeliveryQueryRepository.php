<?php

namespace Modules\Invitation\InvitationDelivery\Repositories;

use Modules\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryQueryRepositoryInterface;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Infrastructure\Eloquent\Models\InvitationDelivery;

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
