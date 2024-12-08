<?php

namespace Infrastructure\Eloquent\Repositories\User;

use Modules\User\Dto\UserCreateRequestDto;
use Modules\User\Dto\UserUpdateRequestDto;
use Domain\User\Repositories\UserCommandRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\User;

final class EloquentUserCommandRepository implements UserCommandRepositoryInterface
{
    public function create(array $data): User
    {
        return User::query()->create($data);
    }

    public function update(int $userId, array $data): User
    {
        $user = User::query()->findOrFail($userId);

        $user->update($data);
       return $user->fresh();
    }

    public function updateEmailVerificationToken(int $userId, string $token): User
    {
        $user = User::query()->findOrFail($userId);
        $user->update(['email_verification_token' => $token]);
        return $user->fresh();
    }
}
