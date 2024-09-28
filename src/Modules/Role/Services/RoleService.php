<?php

namespace Modules\Role\Services;

use Modules\Role\Models\Role;
use App\Models\User;

class RoleService
{
    public function assignRole(int $userId, int $roleId): Role
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);
        $user->roles()->syncWithoutDetaching([$roleId]);

        return $role;
    }
}