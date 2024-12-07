<?php

namespace Modules\Auth\AuthEmail\Http\Actions;

use Modules\Auth\AuthEmail\Http\Requests\AuthEmailUpdateRequest;
use Modules\Auth\AuthEmail\Services\AuthEmailCommandService;
use Illuminate\Http\JsonResponse;

final class AuthEmailUpdateAction
{
    /**
     * @OA\Post(
     *      path="/authEmail/update",
     *      tags={"AuthEmail"},
     *      description="Update email",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email"),
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
     *          description="Unauthenticated!",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthEmailUpdateRequest $request, AuthEmailCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->update($dto);

        return response()->json([
            'message' => trans('messages.auth_email.email_updated'),
        ]);
    }
}
