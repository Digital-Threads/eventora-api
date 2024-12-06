<?php

namespace Modules\Frontend\Dashboard\Role\Services;

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
