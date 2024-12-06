<?php

namespace Modules\Frontend\Dashboard\Invitation\Services;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationViewRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;

final class InvitationQueryService
{
    public function __construct(private readonly InvitationQueryRepositoryInterface $invitationQueryRepository)
    {
    }

    public function view(InvitationViewRequestDto $dto): Invitation
    {
        return $this->invitationQueryRepository->view($dto);
    }

    public function query(InvitationQueryRequestDto $dto): array
    {
        return $this->invitationQueryRepository->query($dto);
    }
}
