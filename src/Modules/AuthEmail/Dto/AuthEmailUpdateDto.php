<?php

namespace Modules\AuthEmail\Dto;

final class AuthEmailUpdateDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $email,
    ) {
        //
    }
}
