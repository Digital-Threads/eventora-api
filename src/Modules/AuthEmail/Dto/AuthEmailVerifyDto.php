<?php

namespace Modules\AuthEmail\Dto;

final class AuthEmailVerifyDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $token,
    ) {
        //
    }
}
