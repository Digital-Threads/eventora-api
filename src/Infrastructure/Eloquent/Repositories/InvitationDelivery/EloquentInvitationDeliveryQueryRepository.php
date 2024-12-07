<?php

namespace Infrastructure\Eloquent\Repositories\InvitationDelivery;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryQueryRepositoryInterface;
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
