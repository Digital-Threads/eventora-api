<?php

namespace Modules\AuthGoogle2FA\Dto;

final class AuthGoogle2FAReissueDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
