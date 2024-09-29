<?php

namespace Modules\User\Services;

use Modules\User\Dto\UserViewRequestDto;
use Infrastructure\Eloquent\Models\User;

final class UserQueryService
{
    /**
     * @param  UserViewRequestDto  $dto
     *
     * @return User
     */
    public function view(UserViewRequestDto $dto): User
    {
        return User::findOrFail($dto->userId);
    }
}