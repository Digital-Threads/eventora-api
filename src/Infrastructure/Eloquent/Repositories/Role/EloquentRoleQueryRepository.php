<?php

namespace Infrastructure\Eloquent\Repositories\Role;

use Domain\Role\Repositories\RoleQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;

final class EloquentRoleQueryRepository implements RoleQueryRepositoryInterface
{
    public function assignRole(int $userId, int $roleId): User
    {
        $user = User::findOrFail($userId);
        $user->role_id = $roleId;
        $user->save(); // Don't forget to save the updated user
        return $user;
    }
}
