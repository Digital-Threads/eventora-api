<?php

namespace Domain\User\Repositories;

use Modules\User\Dto\UserCreateRequestDto;
use Modules\User\Dto\UserUpdateRequestDto;
use Infrastructure\Eloquent\Models\User;

interface UserCommandRepositoryInterface
{
    public function create(UserCreateRequestDto $dto): User;

    public function update(int $userId, UserUpdateRequestDto $dto): void;
}
