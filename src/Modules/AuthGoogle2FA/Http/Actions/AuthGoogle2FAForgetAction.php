<?php

namespace Modules\AuthGoogle2FA\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Modules\AuthGoogle2FA\Http\Requests\AuthGoogle2FAForgetRequest;

final class AuthGoogle2FAForgetAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle2FA/forget",
     *      tags={"AuthGoogle2FA"},
     *      description="Forget issued google 2fa",
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
     *          description="Google 2fa is not issued!",
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
    public function __invoke(AuthGoogle2FAForgetRequest $request, AuthGoogle2FACommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize('auth:google2fa@forget', [$dto]);

        $service->forget($dto);

        return response()->message(trans('messages.auth_google2fa.forgot'));
    }
}
