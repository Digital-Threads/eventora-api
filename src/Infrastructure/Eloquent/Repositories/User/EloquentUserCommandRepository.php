<?php

namespace Infrastructure\Eloquent\Repositories\User;

use Domain\User\Repositories\UserCommandRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserCreateRequestDto;
use Modules\Frontend\Dashboard\User\Dto\UserUpdateRequestDto;

final class EloquentUserCommandRepository implements UserCommandRepositoryInterface
{
    public function create(UserCreateRequestDto $dto): User
    {
        return User::query()->create([
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'role_id' => $dto->roleId,
        ]);
    }

    public function update(int $userId, UserUpdateRequestDto $dto): void
    {
        $user = User::query()->findOrFail($userId);

        $user->update([
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
        ]);
    }
}
