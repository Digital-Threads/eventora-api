<?php

namespace Modules\AuthPassword\Dto;

final class AuthPasswordSendResetLinkDto
{
    public function __construct(
        public readonly string $email,
    ) {
        //
    }
}
