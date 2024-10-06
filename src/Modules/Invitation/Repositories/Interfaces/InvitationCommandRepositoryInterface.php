<?php

namespace Modules\Invitation\Repositories\Interfaces;


use Infrastructure\Eloquent\Models\Invitation;
use Modules\Invitation\Dto\InvitationCreateRequestDto;
use Modules\Invitation\Dto\InvitationUpdateRequestDto;

interface InvitationCommandRepositoryInterface
{
    public function create(InvitationCreateRequestDto $dto): Invitation;

    public function update(InvitationUpdateRequestDto $dto): Invitation;
}
