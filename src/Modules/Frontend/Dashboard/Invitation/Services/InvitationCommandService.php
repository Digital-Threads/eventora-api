<?php

namespace Modules\Frontend\Dashboard\Invitation\Services;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationUpdateRequestDto;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;

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
