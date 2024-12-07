<?php

namespace Modules\Auth\AuthPassword\Http\Actions;

use Modules\Auth\AuthPassword\Http\Requests\AuthPasswordUpdateRequest;
use Modules\Auth\AuthPassword\Services\AuthPasswordCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthPasswordUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authPassword/update",
     *      tags={"AuthPassword"},
     *      description="Update password",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="currentPassword", type="string", nullable=true, format="password"),
     *              @OA\Property(property="password", type="string", format="password"),
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
    public function __invoke(AuthPasswordUpdateRequest $request, AuthPasswordCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->update($dto);

        return response()->message(trans('messages.auth_password.password_updated'));
    }
}
