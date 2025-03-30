<?php

namespace Domain\InvitationDelivery\Repositories;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Enums\InvitationResponseStatus;

interface InvitationDeliveryCommandRepositoryInterface
{
    public function create(InvitationDeliveryCreateDto $dto): InvitationDelivery;

    public function createMultiple(array $deliveriesData): array;

    public function updateResponseStatus(InvitationDelivery $delivery, InvitationResponseStatus $status): void;

}
