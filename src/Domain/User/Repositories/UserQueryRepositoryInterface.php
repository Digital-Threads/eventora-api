<?php

namespace Domain\User\Repositories;

use Modules\User\Dto\UserViewRequestDto;
use Infrastructure\Eloquent\Models\User;

interface UserQueryRepositoryInterface
{
    public function view(UserViewRequestDto $dto): User;
}
