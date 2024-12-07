<?php

namespace Modules\Auth\AuthPassword\Http\Actions;

use Modules\Auth\AuthPassword\Exceptions\AuthPasswordResetFailedException;
use Modules\Auth\AuthPassword\Http\Requests\AuthPasswordSendResetLinkRequest;
use Modules\Auth\AuthPassword\Services\AuthPasswordCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthPasswordSendResetLinkAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authPassword/sendResetLink",
     *      tags={"AuthPassword"},
     *      description="Send password reset link",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email"),
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
     *          description="Failed to send password reset link",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthPasswordSendResetLinkRequest $request, AuthPasswordCommandService $service): JsonResponse
    {
        try {
            $dto = $request->toDto();
            $service->sendResetLink($dto);

            return response()->message(trans('messages.auth_password.password_reset_link_sent'));
        } catch (AuthPasswordResetFailedException) {
            return response()->errorMessage(trans('messages.auth_password.failed_to_send_password_reset_link'));
        }
    }
}
