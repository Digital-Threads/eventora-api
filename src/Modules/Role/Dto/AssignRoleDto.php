<?php

namespace Modules\Role\Dto;

final class AssignRoleDto
{
    public function __construct(
        public readonly int $userId,
        public readonly int $roleId
    ) {
    }
}
