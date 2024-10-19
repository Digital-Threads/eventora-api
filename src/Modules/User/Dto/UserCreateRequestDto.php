<?php

namespace Modules\User\Dto;

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
}
