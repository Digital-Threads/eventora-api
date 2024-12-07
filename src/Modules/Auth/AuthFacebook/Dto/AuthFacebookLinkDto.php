<?php

namespace Modules\Auth\AuthFacebook\Dto;

final class AuthFacebookLinkDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $token,
    ) {
        //
    }
}
