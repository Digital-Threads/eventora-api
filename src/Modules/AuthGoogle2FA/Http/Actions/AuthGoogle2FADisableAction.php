<?php

namespace Modules\AuthGoogle2FA\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Infrastructure\Auth\Checks\UserHasGoogle2FAEnabledCheck;
use Modules\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Modules\AuthGoogle2FA\Http\Requests\AuthGoogle2FADisableRequest;

final class AuthGoogle2FADisableAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle2FA/disable",
     *      tags={"AuthGoogle2FA"},
     *      description="Disable google 2fa",
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
     *          description="Google 2fa is missing or already disabled!",
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
    public function __invoke(AuthGoogle2FADisableRequest $request, AuthGoogle2FACommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogle2FAEnabledCheck(\Auth::user()));

        $service->disable($dto);

        return response()->message(trans('messages.auth_google2fa.disabled'));
    }
}
