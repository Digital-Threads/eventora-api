<?php

namespace Modules\Auth\AuthTrustedDevice\Http\Actions;

use Modules\Auth\AuthTrustedDevice\Http\Requests\AuthTrustedDeviceDeleteRequest;
use Modules\Auth\AuthTrustedDevice\Services\AuthTrustedDeviceCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthTrustedDeviceDeleteAction
{
    use AuthorizesRequests;

    /**
     * @OA\Delete(
     *      path="/authTrustedDevice/{id}",
     *      tags={"AuthTrustedDevice"},
     *      description="Delete trusted device",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="currentPassword", type="string", nullable=true),
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
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthTrustedDeviceDeleteRequest $request, AuthTrustedDeviceCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        //        $this->authorize('auth:trustedDevice@delete', [$dto]);

        $service->delete($dto);

        return response()->json(['message' => (trans('messages.auth_trusted_device.deleted'))]);
    }
}
