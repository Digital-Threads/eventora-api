<?php

namespace Modules\AuthProfile\Dto;

final class AuthProfileViewDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
