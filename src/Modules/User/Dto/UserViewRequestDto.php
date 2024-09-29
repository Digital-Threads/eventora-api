<?php

namespace Modules\User\Dto;

final readonly class UserViewRequestDto
{
    /**
     * @param  int  $userId
     */
    public function __construct(
        public int $userId,
    ) {
        //
    }
}