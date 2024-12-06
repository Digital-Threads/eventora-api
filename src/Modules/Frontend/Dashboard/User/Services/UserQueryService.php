<?php

namespace Modules\Frontend\Dashboard\User\Services;

use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserViewRequestDto;

final class UserQueryService
{
    /**
     *
     */
    public function view(UserViewRequestDto $dto): User
    {
        return User::findOrFail($dto->userId);
    }
}
