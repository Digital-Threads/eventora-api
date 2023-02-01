<?php

namespace Modules\AuthPassword\Dto;

final class AuthPasswordUpdateDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $password,
    ) {
        //
    }
}
