<?php

namespace Modules\Auth\AuthFacebook\Http\Actions;

use Modules\Auth\AuthFacebook\Http\Requests\AuthFacebookLinkRequest;
use Modules\Auth\AuthFacebook\Services\AuthFacebookCommandService;
use Domain\Auth\Checks\UserHasFacebookCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthFacebookLinkAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authFacebook/link",
     *      tags={"AuthFacebook"},
     *      description="Link facebook account",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string"),
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
     *          description="Facebook account is already linked to another account!",
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
    public function __invoke(AuthFacebookLinkRequest $request, AuthFacebookCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasFacebookCheck($request->user()));

        $service->link($dto);

        return response()->message(trans('messages.auth_facebook.facebook_linked'));
    }
}
