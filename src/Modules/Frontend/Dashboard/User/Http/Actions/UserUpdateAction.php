<?php

namespace Modules\Frontend\Dashboard\User\Http\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Http\Requests\UserUpdateRequest;
use Modules\Frontend\Dashboard\User\Services\UserCommandService;

final class UserUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Put(
     *      path="/user/profile",
     *      tags={"User"},
     *      description="Update current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string", nullable=true),
     *              @OA\Property(property="lastName", type="string", nullable=true),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/MessageSchema",
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
     * @throws AuthorizationException
     */
    public function __invoke(UserUpdateRequest $request, UserCommandService $service, User $user): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize($user->id === $request->user()->id);

        $service->update($user->id, $dto);

        return response()->json([
            'message' => trans('messages.user.profile_updated'),
        ]);
    }
}
