<?php

namespace Modules\User\Dto;

final readonly class UserUpdateRequestDto
{
    /**
     */
    public function __construct(
        public string $firstName,
        public string $lastName,
        public int $roleId,
    ) {
    }
}
