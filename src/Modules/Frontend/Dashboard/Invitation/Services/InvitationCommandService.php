<?php

namespace Modules\Frontend\Dashboard\Invitation\Services;

use Domain\Invitation\Repositories\InvitationCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationUpdateRequestDto;

final class InvitationCommandService
{
    public function __construct(
        private readonly InvitationCommandRepositoryInterface $invitationCommandRepository
    ) {
    }

    public function create(InvitationCreateRequestDto $dto): Invitation
    {
        return $this->invitationCommandRepository->create($dto);
    }

    public function update(InvitationUpdateRequestDto $dto): Invitation
    {
        return $this->invitationCommandRepository->update($dto);
    }
}
