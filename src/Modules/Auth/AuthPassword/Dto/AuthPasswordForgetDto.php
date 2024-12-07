<?php

namespace Modules\Auth\AuthPassword\Dto;

final class AuthPasswordForgetDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
