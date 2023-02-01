<?php

namespace Modules\AuthFacebook\Dto;

final class AuthFacebookForgetDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
