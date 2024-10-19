<?php

namespace Modules\Role\Services;


use Infrastructure\Eloquent\Models\Role;
use Infrastructure\Eloquent\Models\User;

class RoleService
{
    public function assignRole(int $userId, int $roleId): User
    {
        $user = User::findOrFail($userId);
        $user->role_id = $roleId;
        return $user;
    }
}
