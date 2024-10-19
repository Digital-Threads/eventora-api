<?php

namespace Modules\User\Dto;

final readonly class UserUpdateRequestDto
{
    /**
     * @param  string  $firstName
     * @param  string  $lastName
     * @param  int  $roleId
     */
    public function __construct(
        public string $firstName,
        public string $lastName,
        public int $roleId,
    ) {}
}
