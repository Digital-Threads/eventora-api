<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\User;
use Modules\User\Dto\UserCreateRequestDto;
use Modules\User\Dto\UserUpdateRequestDto;

final class UserCommandService
{
    /**
     *
     */
    public function update(int $userId, UserUpdateRequestDto $dto): void
    {
        $user = User::findOrFail($userId);

        $user->update([
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
        ]);
    }

    /**
     *
     */
    public function create(UserCreateRequestDto $dto): void
    {
        User::query()->create([
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'role_id' => $dto->roleId,
        ]);
    }
}
