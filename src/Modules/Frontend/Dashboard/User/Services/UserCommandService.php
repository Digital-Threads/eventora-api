<?php

namespace Modules\Frontend\Dashboard\User\Services;

use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserCreateRequestDto;
use Modules\Frontend\Dashboard\User\Dto\UserUpdateRequestDto;

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
