<?php

namespace Modules\Auth\AuthProfile\Http\Actions;

use Modules\Auth\AuthProfile\Http\Requests\AuthProfileUpdateRequest;
use Modules\Auth\AuthProfile\Services\AuthProfileCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Infrastructure\Eloquent\Models\User;

final class AuthProfileUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Put(
     *      path="/authProfile",
     *      tags={"AuthProfile"},
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
     */
    public function __invoke(AuthProfileUpdateRequest $request, AuthProfileCommandService $service, User $user): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize($user->id === $dto->userId);

        $service->update($dto);

        return response()->message(trans('messages.auth_profile.updated'));
    }
}
