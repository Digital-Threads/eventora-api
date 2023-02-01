<?php

namespace Modules\AuthPassword\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthPassword\Services\AuthPasswordCommandService;
use Modules\AuthPassword\Http\Requests\AuthPasswordResetRequest;
use Modules\AuthPassword\Exceptions\AuthPasswordResetFailedException;

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
     *              ref="#/components/schemas/ErrorMessageSchema",
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
