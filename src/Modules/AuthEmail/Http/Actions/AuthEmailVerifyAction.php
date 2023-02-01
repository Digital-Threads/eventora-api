<?php

namespace Modules\AuthEmail\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\AuthEmail\Services\AuthEmailCommandService;
use Modules\AuthEmail\Http\Requests\AuthEmailVerifyRequest;
use Modules\AuthEmail\Exceptions\AuthEmailVerificationFailedException;

final class AuthEmailVerifyAction
{
    /**
     * @OA\Post(
     *      path="/authEmail/verify",
     *      tags={"AuthEmail"},
     *      description="Verify email using verification token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="token", type="string", format="password"),
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
     *          description="Failed email verification",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Too many attempts",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthEmailVerifyRequest $request, AuthEmailCommandService $service): JsonResponse
    {
        try {
            $dto = $request->toDto();
            $service->verify($dto);

            return response()->message(trans('messages.auth_email.email_verified'));
        } catch (AuthEmailVerificationFailedException) {
            return response()->errorMessage(trans('messages.auth_email.email_verification_failed'));
        }
    }
}
