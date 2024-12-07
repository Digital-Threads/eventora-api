<?php

namespace Domain\Invitation\Repositories;

use Modules\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Invitation\Dto\InvitationUpdateRequestDto;
use Infrastructure\Eloquent\Models\Invitation;

interface InvitationCommandRepositoryInterface
{
    public function create(InvitationCreateRequestDto $dto): Invitation;

    public function update(InvitationUpdateRequestDto $dto): Invitation;
}
