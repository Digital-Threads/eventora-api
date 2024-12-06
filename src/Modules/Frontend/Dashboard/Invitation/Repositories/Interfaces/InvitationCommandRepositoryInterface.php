<?php

namespace Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationUpdateRequestDto;

interface InvitationCommandRepositoryInterface
{
    public function create(InvitationCreateRequestDto $dto): Invitation;

    public function update(InvitationUpdateRequestDto $dto): Invitation;
}
