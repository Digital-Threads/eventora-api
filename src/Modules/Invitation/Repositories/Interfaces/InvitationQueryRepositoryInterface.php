<?php

namespace Modules\Invitation\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Invitation\Dto\InvitationViewRequestDto;

interface InvitationQueryRepositoryInterface
{
    public function view(InvitationViewRequestDto $dto): Invitation;

    public function query(InvitationQueryRequestDto $dto): array;
}