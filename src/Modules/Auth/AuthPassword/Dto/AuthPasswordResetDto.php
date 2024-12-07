<?php

namespace Modules\Auth\AuthPassword\Dto;

final class AuthPasswordResetDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $token,
        public readonly string $password,
    ) {
        //
    }
}
