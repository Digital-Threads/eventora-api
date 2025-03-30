<?php

namespace Domain\InvitationDelivery\Repositories;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Infrastructure\Eloquent\Models\InvitationDelivery;

interface InvitationDeliveryQueryRepositoryInterface
{
    public function query(InvitationDeliveryQueryRequestDto $dto): array;
    public function view(int $id): InvitationDelivery;
}
