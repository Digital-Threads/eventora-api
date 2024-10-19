<?php

namespace Modules\User\Dto;

final readonly class UserUpdateRequestDto
{
    /**
     */
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
        public int $role_id,
    ) {
    }
}
