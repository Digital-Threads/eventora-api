<?php

namespace Modules\Auth\AuthEmail\Http\Actions;

use Modules\Auth\AuthEmail\Http\Requests\AuthEmailSendVerificationLinkRequest;
use Modules\Auth\AuthEmail\Services\AuthEmailCommandService;
use Domain\Auth\Checks\UserHasEmailCheck;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

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
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated!",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     * @throws AuthorizationException
     */
    public function __invoke(AuthEmailSendVerificationLinkRequest $request, AuthEmailCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasEmailCheck($request->user()));

        $service->sendVerificationLink($dto);

        return response()->json([
            'message' => trans('messages.auth_email.verification_link_sent'),
        ]);
    }
}
