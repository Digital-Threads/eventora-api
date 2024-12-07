<?php

namespace Modules\Auth\AuthEmail\Http\Actions;

use Modules\Auth\AuthEmail\Http\Requests\AuthEmailForgetRequest;
use Modules\Auth\AuthEmail\Services\AuthEmailCommandService;
use Domain\Auth\Checks\UserHasEmailCheck;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

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
        $this->authorize(new UserHasEmailCheck($request->user()));

        $service->forget($dto);

        return response()->message(trans('messages.auth_email.email_forgot'));
    }
}
