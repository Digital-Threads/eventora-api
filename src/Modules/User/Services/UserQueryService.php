<?php

namespace Modules\User\Services;

use Infrastructure\Eloquent\Models\User;
use Modules\User\Dto\UserViewRequestDto;

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
