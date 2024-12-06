<?php

namespace Modules\Frontend\Dashboard\Role\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Frontend\Dashboard\Role\Services\RoleService;
use Modules\Frontend\Dashboard\Role\Http\Resources\RoleResource;
use Modules\Frontend\Dashboard\Role\Http\Requests\AssignRoleRequest;

/**
 * @OA\Post(
 *     path="/roles/assign",
 *     operationId="assignRole",
 *     tags={"Roles"},
 *     security={
 *          {"token": {}},
 *     },
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer", description="User ID"),
 *             @OA\Property(property="role_id", type="integer", description="Role ID")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Role assigned successfully",
 *         @OA\JsonContent(ref="#/components/schemas/RoleSchema")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User or Role not found",
 *         @OA\JsonContent(type="object", ref="#/components/schemas/ErrorSchema"),
 *     ),
 * )
 */
final class AssignRoleAction
{
    public function __invoke(AssignRoleRequest $request, RoleService $service): JsonResource
    {
        $dto = $request->toDto();
        $role = $service->assignRole($dto->userId, $dto->roleId);

        return new RoleResource($role);
    }
}
