<?php

namespace Modules\Invitation\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Invitation\Dto\InvitationViewRequestDto;
use Modules\Invitation\Dto\InvitationQueryRequestDto;

interface InvitationQueryRepositoryInterface
{
    public function query(InvitationQueryRequestDto $dto): array;

    public function view(InvitationViewRequestDto $dto): Invitation;
}
