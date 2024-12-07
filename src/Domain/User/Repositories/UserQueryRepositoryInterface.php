<?php

namespace Domain\User\Repositories;

use Modules\User\Dto\UserViewRequestDto;
use Infrastructure\Eloquent\Models\User;

interface UserQueryRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function findById(int $id): ?User;


    public function existsBySocialId(string $socialId, string $provider): bool;

    public function findAllByUserId(int $userId): iterable;

}
