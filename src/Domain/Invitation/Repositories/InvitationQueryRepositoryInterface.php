<?php

namespace Domain\Invitation\Repositories;

use Infrastructure\Eloquent\Models\Invitation;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationViewRequestDto;

interface InvitationQueryRepositoryInterface
{
    public function query(InvitationQueryRequestDto $dto): array;

    public function view(InvitationViewRequestDto $dto): Invitation;
}
