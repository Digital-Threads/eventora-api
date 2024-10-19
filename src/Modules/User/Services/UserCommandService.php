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
    public function update(UserUpdateRequestDto $dto): void
    {
        $user = User::findOrFail($dto->userId);

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
        User::create([
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
        ]);
    }
}
