<?php

namespace Modules\Invitation\Services;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Invitation\Dto\InvitationViewRequestDto;
use Modules\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;

final class InvitationQueryService
{
    public function __construct(private InvitationQueryRepositoryInterface $invitationQueryRepository) {}

    public function view(InvitationViewRequestDto $dto): Invitation
    {
        return $this->invitationQueryRepository->view($dto);
    }

    public function query(InvitationQueryRequestDto $dto): array
    {
        return $this->invitationQueryRepository->query($dto);
    }
}