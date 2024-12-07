<?php

namespace Modules\User\Dto;

final readonly class UserViewRequestDto
{
    /**
     */
    public function __construct(
        public int $userId,
    ) {
        //
    }
}
