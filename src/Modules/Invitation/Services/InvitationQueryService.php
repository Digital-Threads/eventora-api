<?php

namespace Modules\Invitation\Services;

use Modules\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Invitation\Dto\InvitationViewRequestDto;
use Domain\Invitation\Repositories\InvitationQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\Invitation;

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
