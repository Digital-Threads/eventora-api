<?php

namespace Modules\Auth\AuthGoogle\Dto;

final class AuthGoogleLinkDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $token,
    ) {
        //
    }
}
