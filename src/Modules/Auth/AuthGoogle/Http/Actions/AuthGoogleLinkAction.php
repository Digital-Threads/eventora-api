<?php

namespace Modules\Auth\AuthGoogle\Http\Actions;

use Modules\Auth\AuthGoogle\Http\Requests\AuthGoogleLinkRequest;
use Modules\Auth\AuthGoogle\Services\AuthGoogleCommandService;
use Domain\Auth\Checks\UserHasGoogleCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthGoogleLinkAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle/link",
     *      tags={"AuthGoogle"},
     *      description="Link google account",
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
     *          description="Google account is already linked to another account!",
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
    public function __invoke(AuthGoogleLinkRequest $request, AuthGoogleCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogleCheck($request->user()));

        $service->link($dto);

        return response()->message(trans('messages.auth_google.google_linked'));
    }
}
