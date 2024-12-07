<?php

namespace Modules\Auth\AuthFacebook\Http\Actions;

use Modules\Auth\AuthFacebook\Http\Requests\AuthFacebookForgetRequest;
use Modules\Auth\AuthFacebook\Services\AuthFacebookCommandService;
use Domain\Auth\Checks\UserHasFacebookCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthFacebookForgetAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authFacebook/forget",
     *      tags={"AuthFacebook"},
     *      description="Forget facebook account linking",
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
     *          description="Facebook account is not linked!",
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
    public function __invoke(AuthFacebookForgetRequest $request, AuthFacebookCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasFacebookCheck($request->user()));

        $service->forget($dto);

        return response()->message(trans('messages.auth_facebook.facebook_forgot'));
    }
}
