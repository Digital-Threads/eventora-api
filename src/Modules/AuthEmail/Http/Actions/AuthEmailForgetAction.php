<?php

namespace Modules\AuthEmail\Http\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Infrastructure\Auth\Checks\UserHasEmailCheck;
use Modules\AuthEmail\Services\AuthEmailCommandService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthEmail\Http\Requests\AuthEmailForgetRequest;

final class AuthEmailForgetAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authEmail/forget",
     *      tags={"AuthEmail"},
     *      description="Forget email",
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
     *          response=401,
     *          description="Unauthenticated!",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     * @throws AuthorizationException
     */
    public function __invoke(AuthEmailForgetRequest $request, AuthEmailCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasEmailCheck(Auth::user()));

        $service->forget($dto);

        return response()->message(trans('messages.auth_email.email_forgot'));
    }
}
