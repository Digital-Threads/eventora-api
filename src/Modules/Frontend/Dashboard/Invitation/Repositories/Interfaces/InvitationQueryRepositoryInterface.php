<?php

namespace Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationViewRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationQueryRequestDto;

interface InvitationQueryRepositoryInterface
{
    public function query(InvitationQueryRequestDto $dto): array;

    public function view(InvitationViewRequestDto $dto): Invitation;
}
