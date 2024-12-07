<?php

namespace Modules\Auth\AuthPassword\Http\Actions;

use Modules\Auth\AuthPassword\Http\Requests\AuthPasswordForgetRequest;
use Modules\Auth\AuthPassword\Services\AuthPasswordCommandService;
use Domain\Auth\Checks\UserHasPasswordCheck;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class AuthPasswordForgetAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/authPassword/forget",
     *      tags={"AuthPassword"},
     *      description="Forget password",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="password", type="string", format="password"),
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
     *          description="User does not have current password",
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
     * @throws AuthorizationException
     */
    public function __invoke(AuthPasswordForgetRequest $request, AuthPasswordCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(new UserHasPasswordCheck($request->user()));

        $service->forget($dto);

        return response()->message(trans('messages.auth_password.password_forgot'));
    }
}
