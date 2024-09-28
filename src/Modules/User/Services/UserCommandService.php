<?php

namespace Modules\User\Services;

use Modules\User\Dto\UserUpdateRequestDto;
use Modules\User\Dto\UserCreateRequestDto;
use Infrastructure\Eloquent\Models\User;
use Illuminate\Support\Facades\Hash;

final class UserCommandService
{
    public function update(UserUpdateRequestDto $dto): void
    {
        $user = User::findOrFail($dto->userId);

        $user->update([
            'first_name' => $dto->firstName,
            'last_name'  => $dto->lastName,
        ]);
    }

    public function create(UserCreateRequestDto $dto): void
    {
        User::create([
            'email'      => $dto->email,
            'password'   => Hash::make($dto->password),
            'first_name' => $dto->firstName,
            'last_name'  => $dto->lastName,
        ]);
    }
}