<?php

namespace Modules\Auth\AuthEmail\Dto;

final class AuthEmailSendVerificationLinkDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
