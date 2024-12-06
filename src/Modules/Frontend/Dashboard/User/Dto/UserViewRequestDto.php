<?php

namespace Modules\Frontend\Dashboard\User\Dto;

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
