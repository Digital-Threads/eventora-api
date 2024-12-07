<?php

namespace Domain\Role\Repositories;

use Infrastructure\Eloquent\Models\User;

interface RoleQueryRepositoryInterface
{
    public function assignRole(int $userId, int $roleId): User;
}
