<?php

namespace Modules\Invitation\InvitationDelivery\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;

interface InvitationDeliveryCommandRepositoryInterface
{
    public function create(InvitationDeliveryCreateDto $dto): InvitationDelivery;

    public function createMultiple(array $deliveriesData): array;
}
