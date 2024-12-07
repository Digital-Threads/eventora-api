<?php

namespace Domain\InvitationDelivery\Repositories;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;
use Infrastructure\Eloquent\Models\InvitationDelivery;

interface InvitationDeliveryCommandRepositoryInterface
{
    public function create(InvitationDeliveryCreateDto $dto): InvitationDelivery;

    public function createMultiple(array $deliveriesData): array;
}
