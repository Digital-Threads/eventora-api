<?php

namespace Modules\Invitation\Repositories\Interfaces;

use Modules\Invitation\Dto\InvitationCreateDto;
use Modules\Invitation\Dto\InvitationUpdateDto;
use Infrastructure\Eloquent\Models\Invitation;

interface InvitationCommandRepositoryInterface
{
    public function create(InvitationCreateDto $dto): Invitation;
    public function update(InvitationUpdateDto $dto): Invitation;
    public function delete(int $invitationId): void;
}