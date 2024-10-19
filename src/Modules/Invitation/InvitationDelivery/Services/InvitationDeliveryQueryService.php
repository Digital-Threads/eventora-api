<?php

namespace Modules\Invitation\InvitationDelivery\Services;

use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Modules\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryQueryRepositoryInterface;

final class InvitationDeliveryQueryService
{
    public function __construct(private InvitationDeliveryQueryRepositoryInterface $invitationDeliveryQueryRepository)
    {
    }

    public function query(InvitationDeliveryQueryRequestDto $dto): array
    {
        return $this->invitationDeliveryQueryRepository->query($dto);
    }

    public function view(int $id): InvitationDelivery
    {
        return $this->invitationDeliveryQueryRepository->view($id);
    }
}
