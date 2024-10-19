<?php

namespace Modules\Invitation\Services;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Invitation\Dto\InvitationUpdateRequestDto;
use Modules\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;

final class InvitationCommandService
{
    public function __construct(
        private readonly InvitationCommandRepositoryInterface $invitationCommandRepository
    ) {}

    public function create(InvitationCreateRequestDto $dto): Invitation
    {
        return $this->invitationCommandRepository->create($dto);
    }

    public function update(InvitationUpdateRequestDto $dto): Invitation
    {
        return $this->invitationCommandRepository->update($dto);
    }
}

