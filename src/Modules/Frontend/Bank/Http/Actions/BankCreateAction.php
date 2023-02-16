<?php

namespace Modules\Frontend\Bank\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Bank\Http\Requests\BankCreateRequest;
use Modules\Frontend\Bank\Services\BankCommandService;

final class BankCreateAction
{

    /**
     * @OA\Put(
     *      path="/bank",
     *      tags={"Bank"},
     *      description="Create current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="compnay_id", type="string", nullable=false),
     *              @OA\Property(property="bank_name", type="string", nullable=false),
     *              @OA\Property(property="country", type="string", nullable=true),
     *              @OA\Property(property="city", type="int", nullable=true),
     *              @OA\Property(property="address", type="int", nullable=true),
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
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(BankCreateRequest $request, BankCommandService $service): JsonResponse
    {
        $dto = $request->toDto();

        $service->createBank($dto);

        return response()->message(trans('messages.auth_profile.updated'));
    }
}
