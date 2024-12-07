<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Actions;

use Modules\Auth\AuthGoogle2FA\Http\Requests\AuthGoogle2FAForgetRequest;
use Modules\Auth\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Domain\Auth\Checks\UserHasGoogle2FAEnabledCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

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
     */
    public function __invoke(AuthGoogle2FAForgetRequest $request, AuthGoogle2FACommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogle2FAEnabledCheck($request->user()));

        $service->forget($dto);

        return response()->message(trans('messages.auth_google2fa.forgot'));
    }
}
