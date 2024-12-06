<?php

namespace Modules\Frontend\Dashboard\User\Http\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Http\Requests\UserViewRequest;
use Modules\Frontend\Dashboard\User\Http\Resources\UserResource;
use Modules\Frontend\Dashboard\User\Services\UserQueryService;

/**
 * @OA\Get(
 *      path="/user/profile",
 *      tags={"User"},
 *      description="Get current authenticated user profile",
 *      security={
 *          {"passport": {}},
 *      },
 *      @OA\Response(
 *          response=200,
 *          description="Successful",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", ref="#/components/schemas/UserSchema"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              type="object",
 *              ref="#/components/schemas/ErrorSchema",
 *          ),
 *      ),
 * )
 */
final class UserViewAction
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *      path="/user/profile",
     *      tags={"User"},
     *      description="Get current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/UserSchema"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(UserViewRequest $request, UserQueryService $service, User $user): JsonResource
    {
        $dto = $request->toDto();
        $me = $service->view($dto);

        return new UserResource($me);
    }
}
