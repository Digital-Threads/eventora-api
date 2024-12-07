<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Services;

use Domain\InvitationDelivery\Repositories\InvitationDeliveryQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;

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
