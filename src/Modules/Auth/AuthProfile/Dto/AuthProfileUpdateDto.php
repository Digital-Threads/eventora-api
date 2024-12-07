<?php

namespace Modules\Auth\AuthProfile\Dto;

final class AuthProfileUpdateDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $firstName,
        public readonly string $lastName,
    ) {
        //
    }
}
