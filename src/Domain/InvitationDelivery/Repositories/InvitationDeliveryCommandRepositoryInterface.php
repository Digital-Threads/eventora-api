<?php

namespace Domain\InvitationDelivery\Repositories;

use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;

interface InvitationDeliveryCommandRepositoryInterface
{
    public function create(InvitationDeliveryCreateDto $dto): InvitationDelivery;

    public function createMultiple(array $deliveriesData): array;
}
