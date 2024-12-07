<?php

namespace Modules\Frontend\Dashboard\User\Services;


use Domain\User\Repositories\UserCommandRepositoryInterface;
use Modules\Frontend\Dashboard\User\Dto\UserCreateRequestDto;
use Modules\Frontend\Dashboard\User\Dto\UserUpdateRequestDto;

final readonly class UserCommandService
{
    public function __construct(private UserCommandRepositoryInterface $userCommandRepository) {}

    public function create(UserCreateRequestDto $dto): void
    {
        $this->userCommandRepository->create($dto);
    }

    public function update(int $userId, UserUpdateRequestDto $dto): void
    {
        $this->userCommandRepository->update($userId, $dto);
    }
}
