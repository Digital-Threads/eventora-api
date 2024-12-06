<?php

namespace Modules\Frontend\Dashboard\Role\Dto;

final readonly class AssignRoleDto
{
    public function __construct(
        public int $userId,
        public int $roleId
    ) {
    }
}
