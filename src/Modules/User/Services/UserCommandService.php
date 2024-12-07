<?php

namespace Modules\User\Services;


use Modules\User\Dto\UserCreateRequestDto;
use Modules\User\Dto\UserUpdateRequestDto;
use Domain\User\Repositories\UserCommandRepositoryInterface;

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
