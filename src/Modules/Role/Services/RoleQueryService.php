<?php

namespace Modules\Role\Services;


use Domain\Role\Repositories\RoleQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;

class RoleQueryService
{
    public function __construct(private readonly RoleQueryRepositoryInterface $roleRepository) {}

    public function assignRole(int $userId, int $roleId): User
    {
        return $this->roleRepository->assignRole($userId, $roleId);
    }
}
