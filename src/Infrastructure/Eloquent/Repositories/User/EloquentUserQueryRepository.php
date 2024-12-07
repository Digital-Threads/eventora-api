<?php

namespace Infrastructure\Eloquent\Repositories\User;

use Domain\User\Repositories\UserQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserViewRequestDto;

final class EloquentUserQueryRepository implements UserQueryRepositoryInterface
{
    public function view(UserViewRequestDto $dto): User
    {
        return User::query()->findOrFail($dto->userId);
    }
}
