<?php

namespace Modules\AuthTrustedDevice\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthTrustedDevice\Services\AuthTrustedDeviceQueryService;
use Modules\AuthTrustedDevice\Http\Resources\AuthTrustedDeviceResource;
use Modules\AuthTrustedDevice\Http\Requests\AuthTrustedDeviceViewRequest;

final class AuthTrustedDeviceViewAction
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *      path="/authTrustedDevice/{id}",
     *      tags={"AuthTrustedDevice"},
     *      description="View trusted device",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          parameter="id",
     *          @OA\Schema(type="integer"),
     *          in="path",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/AuthTrustedDeviceSchema"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthTrustedDeviceViewRequest $request, AuthTrustedDeviceQueryService $service): JsonResource
    {
        $dto = $request->toDto();
//        $this->authorize('auth:trustedDevice@view', [$dto]);

        $device = $service->view($dto);

        return new AuthTrustedDeviceResource($device);
    }
}
