<?php

namespace Modules\AuthEmail\Dto;

final class AuthEmailSendVerificationLinkDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
