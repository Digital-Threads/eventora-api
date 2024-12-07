<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Actions;

use Modules\Auth\AuthGoogle2FA\Http\Requests\AuthGoogle2FAReissueRequest;
use Modules\Auth\AuthGoogle2FA\Http\Resources\AuthGoogle2FACredentialsResource;
use Modules\Auth\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Domain\Auth\Checks\UserHasGoogle2FAEnabledCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\JsonResource;

final class AuthGoogle2FAReissueAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle2FA/reissue",
     *      tags={"AuthGoogle2FA"},
     *      description="Issue current google 2fa qr code",
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
     *          description="Google 2fa has not been issued!",
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
    public function __invoke(AuthGoogle2FAReissueRequest $request, AuthGoogle2FACommandService $service): JsonResource
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogle2FAEnabledCheck($request->user()));

        $credentials = $service->reissue($dto);

        return new AuthGoogle2FACredentialsResource($credentials);
    }
}
