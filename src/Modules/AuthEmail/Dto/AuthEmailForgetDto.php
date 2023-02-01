<?php

namespace Modules\AuthEmail\Dto;

final class AuthEmailForgetDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
