<?php

namespace Modules\Invitation\Services;

use Modules\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Invitation\Dto\InvitationUpdateRequestDto;
use Domain\Invitation\Repositories\InvitationCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Invitation;

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
