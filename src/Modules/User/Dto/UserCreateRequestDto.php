<?php

namespace Modules\User\Dto;

final readonly class UserCreateRequestDto
{
    /**
     * @param  string  $first_name
     * @param  string  $last_name
     * @param  string  $email
     * @param  string  $password
     * @param  int  $role_id
     */
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
        public int $role_id,
    ) {}
}