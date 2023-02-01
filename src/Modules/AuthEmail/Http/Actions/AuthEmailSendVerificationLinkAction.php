<?php

namespace Modules\AuthEmail\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\AuthEmail\Services\AuthEmailCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthEmail\Http\Requests\AuthEmailSendVerificationLinkRequest;

final class AuthEmailSendVerificationLinkAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authEmail/sendVerificationLink",
     *      tags={"AuthEmail"},
     *      description="Send email verification link",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/MessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Unexpected error or user email is already verified!",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated!",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthEmailSendVerificationLinkRequest $request, AuthEmailCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize('auth:email@sendVerificationLink', [$dto]);

        $service->sendVerificationLink($dto);

        return response()->message(trans('messages.auth_email.verification_link_sent'));
    }
}
