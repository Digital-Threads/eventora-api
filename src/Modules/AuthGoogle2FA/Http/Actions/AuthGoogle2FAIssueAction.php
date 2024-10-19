<?php

namespace Modules\AuthGoogle2FA\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Infrastructure\Auth\Checks\UserHasGoogle2FAEnabledCheck;
use Modules\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Modules\AuthGoogle2FA\Http\Requests\AuthGoogle2FAIssueRequest;
use Modules\AuthGoogle2FA\Http\Resources\AuthGoogle2FACredentialsResource;

final class AuthGoogle2FAIssueAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle2FA/issue",
     *      tags={"AuthGoogle2FA"},
     *      description="Issue new google 2fa qr code",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/AuthGoogle2FACredentialsSchema"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Google 2fa is already issued!",
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
    public function __invoke(AuthGoogle2FAIssueRequest $request, AuthGoogle2FACommandService $service): JsonResource
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogle2FAEnabledCheck(\Auth::user()));

        $credentials = $service->issue($dto);

        return new AuthGoogle2FACredentialsResource($credentials);
    }
}
