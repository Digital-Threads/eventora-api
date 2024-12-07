<?php

namespace Modules\Auth\AuthGoogle2FA\Dto;

final class AuthGoogle2FAIssueDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
