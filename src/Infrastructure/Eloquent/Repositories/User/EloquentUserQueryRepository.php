<?php

namespace Infrastructure\Eloquent\Repositories\User;

use Modules\User\Dto\UserViewRequestDto;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;

final class EloquentUserQueryRepository implements UserQueryRepositoryInterface
{
    public function view(UserViewRequestDto $dto): User
    {
        return User::query()->findOrFail($dto->userId);
    }
}
