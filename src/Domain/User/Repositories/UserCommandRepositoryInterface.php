<?php

namespace Domain\User\Repositories;

use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserCreateRequestDto;
use Modules\Frontend\Dashboard\User\Dto\UserUpdateRequestDto;

interface UserCommandRepositoryInterface
{
    public function create(UserCreateRequestDto $dto): User;

    public function update(int $userId, UserUpdateRequestDto $dto): void;
}
