<?php

namespace Modules\AuthGoogle\Http\Actions;

use Illuminate\Http\JsonResponse;
use Infrastructure\Auth\Checks\UserHasGoogleCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthGoogle\Services\AuthGoogleCommandService;
use Modules\AuthGoogle\Http\Requests\AuthGoogleForgetRequest;

final class AuthGoogleForgetAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authGoogle/forget",
     *      tags={"AuthGoogle"},
     *      description="Forget google account linking",
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
     *          description="Google account is not linked!",
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
    public function __invoke(AuthGoogleForgetRequest $request, AuthGoogleCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasGoogleCheck(\Auth::user()));

        $service->forget($dto);

        return response()->json([
            'message' => trans('messages.auth_google.google_forgot')
        ]);
    }
}
