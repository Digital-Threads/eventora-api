<?php

namespace Modules\Frontend\Dashboard\User\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\User\Http\Requests\UserCreateRequest;
use Modules\Frontend\Dashboard\User\Services\UserCommandService;


final class UserCreateAction
{
    /**
     * @OA\Post(
     *      path="/user/create",
     *      tags={"User"},
     *      summary="Create a new user",
     *      description="Creates a new user with provided details",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", example="user@example.com"),
     *              @OA\Property(property="password", type="string", example="password123"),
     *              @OA\Property(property="firstName", type="string", nullable=true, example="John"),
     *              @OA\Property(property="lastName", type="string", nullable=true, example="Doe"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="User created successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="User created successfully."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="errors", type="object", example={"email": {"The email field is required."}}),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
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
        ], 201);
    }
}