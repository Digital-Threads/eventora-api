<?php

namespace Modules\Invitation\InvitationDelivery\Services;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\InvitationDelivery;

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
