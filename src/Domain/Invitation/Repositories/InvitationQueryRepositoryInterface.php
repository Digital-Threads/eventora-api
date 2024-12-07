<?php

namespace Domain\Invitation\Repositories;

use Modules\Invitation\Dto\InvitationQueryRequestDto;
use Modules\Invitation\Dto\InvitationViewRequestDto;
use Infrastructure\Eloquent\Models\Invitation;

interface InvitationQueryRepositoryInterface
{
    public function query(InvitationQueryRequestDto $dto): array;

    public function view(InvitationViewRequestDto $dto): Invitation;
}
