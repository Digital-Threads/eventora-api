<?php

namespace Modules\Invitation\Services;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Invitation\Dto\InvitationCreateDto;
use Modules\Invitation\Dto\InvitationUpdateDto;
use Modules\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;

final class InvitationCommandService
{
    public function __construct(private InvitationCommandRepositoryInterface $invitationCommandRepository) {}

    public function create(InvitationCreateDto $dto): Invitation
    {
        return $this->invitationCommandRepository->create($dto);
    }

    public function update(InvitationUpdateDto $dto): Invitation
    {
        return $this->invitationCommandRepository->update($dto);
    }
}