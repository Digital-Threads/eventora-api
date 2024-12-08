<?php

namespace Modules\User\Dto;

use Illuminate\Support\Facades\Hash;

final readonly class UserCreateRequestDto
{
    /**
     */
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public int $roleId,
    ) {
    }

    public function toArray(): array{
        return [
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'role_id' => $this->roleId,
        ];
    }
}
