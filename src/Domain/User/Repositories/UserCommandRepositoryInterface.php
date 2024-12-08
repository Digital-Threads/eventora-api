<?php

namespace Domain\User\Repositories;

use Modules\User\Dto\UserCreateRequestDto;
use Modules\User\Dto\UserUpdateRequestDto;
use Infrastructure\Eloquent\Models\User;

interface UserCommandRepositoryInterface
{
    public function create(array $data): User;

    public function update(int $userId, array $data): User;
    public function updateEmailVerificationToken(int $userId, string $token): User;
}
