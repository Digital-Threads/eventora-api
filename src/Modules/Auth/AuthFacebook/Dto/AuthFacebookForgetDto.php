<?php

namespace Modules\Auth\AuthFacebook\Dto;

final class AuthFacebookForgetDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
