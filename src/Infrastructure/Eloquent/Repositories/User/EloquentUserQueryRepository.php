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

    public function findById(int $id): User
    {
        return User::query()->findOrFail($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }

    public function existsBySocialId(string $socialId, string $provider): bool
    {
        return User::query()->where("{$provider}_id", $socialId)->exists();
    }

    public function findAllByUserId(int $userId): iterable
    {
        return User::query()->where('id', $userId)->get();
    }

    public function findWithEmailAndToken(string $email, string $token): ?User
    {
        return User::query()
            ->where('email', $email)
            ->where('email_verification_token', $token)
            ->firstOrFail();
    }
}
