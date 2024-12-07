<?php

namespace Modules\Role\Dto;

final readonly class AssignRoleDto
{
    public function __construct(
        public int $userId,
        public int $roleId
    ) {
    }
}
