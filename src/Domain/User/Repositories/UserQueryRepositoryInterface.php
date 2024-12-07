<?php

namespace Domain\User\Repositories;

use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserViewRequestDto;

interface UserQueryRepositoryInterface
{
    public function view(UserViewRequestDto $dto): User;
}
