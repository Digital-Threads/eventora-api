<?php

namespace Modules\AuthGoogle2FA\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthGoogle2FA\Services\AuthGoogle2FACommandService;
use Modules\AuthGoogle2FA\Http\Requests\AuthGoogle2FAReissueRequest;
use Modules\AuthGoogle2FA\Http\Resources\AuthGoogle2FACredentialsResource;

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
    public function __invoke(AuthGoogle2FAReissueRequest $request, AuthGoogle2FACommandService $service): JsonResource
    {
        $dto = $request->toDto();
        $this->authorize('auth:google2fa@reissue', [$dto]);

        $credentials = $service->reissue($dto);

        return new AuthGoogle2FACredentialsResource($credentials);
    }
}
