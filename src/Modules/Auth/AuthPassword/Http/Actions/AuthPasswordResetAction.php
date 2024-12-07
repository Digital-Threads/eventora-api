<?php

namespace Modules\Auth\AuthPassword\Http\Actions;

use Modules\Auth\AuthPassword\Exceptions\AuthPasswordResetFailedException;
use Modules\Auth\AuthPassword\Http\Requests\AuthPasswordResetRequest;
use Modules\Auth\AuthPassword\Services\AuthPasswordCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthPasswordResetAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authPassword/reset",
     *      tags={"AuthPassword"},
     *      description="Reset password",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="token", type="string", format="password"),
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
     *          response=400,
     *          description="Failed reset password",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthPasswordResetRequest $request, AuthPasswordCommandService $service): JsonResponse
    {
        try {
            $dto = $request->toDto();
            $service->reset($dto);

            return response()->message(trans('messages.auth_password.password_reset'));
        } catch (AuthPasswordResetFailedException) {
            return response()->errorMessage(trans('messages.auth_password.failed_to_reset_password'));
        }
    }
}
