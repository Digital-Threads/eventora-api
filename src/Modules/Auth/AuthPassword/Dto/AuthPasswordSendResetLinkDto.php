<?php

namespace Modules\Auth\AuthPassword\Dto;

final class AuthPasswordSendResetLinkDto
{
    public function __construct(
        public readonly string $email,
    ) {
        //
    }
}
