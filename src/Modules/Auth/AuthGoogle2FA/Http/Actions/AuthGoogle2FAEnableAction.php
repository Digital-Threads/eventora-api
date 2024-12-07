<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Actions;

use Modules\Auth\AuthGoogle2FA\Http\Requests\AuthGoogle2FAEnableRequest;
use Modules\Auth\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Domain\Auth\Checks\UserHasGoogle2FACheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthGoogle2FAEnableAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle2FA/enable",
     *      tags={"AuthGoogle2FA"},
     *      description="Enable google 2fa",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="otp", type="string"),
     *              @OA\Property(property="trusted", type="boolean"),
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
     *          response=403,
     *          description="Google 2fa is missing or already enabled!",
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
    public function __invoke(AuthGoogle2FAEnableRequest $request, AuthGoogle2FACommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogle2FACheck($request->user()));

        $service->enable($dto);

        return response()->message(trans('messages.auth_google2fa.enabled'));
    }
}
