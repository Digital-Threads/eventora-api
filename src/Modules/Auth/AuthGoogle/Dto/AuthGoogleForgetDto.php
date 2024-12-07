<?php

namespace Modules\Auth\AuthGoogle\Dto;

final class AuthGoogleForgetDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
