<?php

namespace Modules\AuthPassword\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Infrastructure\Auth\Checks\UserHasPasswordCheck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthPassword\Services\AuthPasswordCommandService;
use Modules\AuthPassword\Http\Requests\AuthPasswordForgetRequest;

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
