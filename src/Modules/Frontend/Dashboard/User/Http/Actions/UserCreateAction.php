<?php

namespace Modules\Frontend\Dashboard\User\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\User\Http\Requests\UserCreateRequest;
use Modules\Frontend\Dashboard\User\Services\UserCommandService;

/**
 * @OA\Post(
 *      path="/user/create",
 *      tags={"User"},
 *      description="Create a new user",
 *      security={
 *          {"passport": {}},
 *      },
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="email", type="string", nullable=false),
 *              @OA\Property(property="password", type="string", nullable=false),
 *              @OA\Property(property="firstName", type="string", nullable=true),
 *              @OA\Property(property="lastName", type="string", nullable=true),
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
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              type="object",
 *              ref="#/components/schemas/ErrorSchema",
 *          ),
 *      ),
 * )
 */
final class UserCreateAction
{
    /**
     * @OA\Post(
     *      path="/user/create",
     *      tags={"User"},
     *      description="Create a new user",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", nullable=false),
     *              @OA\Property(property="password", type="string", nullable=false),
     *              @OA\Property(property="firstName", type="string", nullable=true),
     *              @OA\Property(property="lastName", type="string", nullable=true),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="User created",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/MessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */

    public function __invoke(UserCreateRequest $request, UserCommandService $service): JsonResponse
    {
        $dto = $request->toDto();

        $service->create($dto);

        return response()->json([
            'message' => trans('messages.user.created'),
        ]);
    }
}
