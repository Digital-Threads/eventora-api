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

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function existsBySocialId(string $socialId, string $provider): bool
    {
        return User::where("{$provider}_id", $socialId)->exists();
    }

    public function findAllByUserId(int $userId): iterable
    {
        return User::where('id', $userId)->get();
    }
}
