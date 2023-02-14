<?php

namespace Modules\Frontend\BankAccount\Http\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\BankAccount\Services\BankAccountCommandService;
use Modules\Frontend\BankAccount\Http\Requests\BankAccountCreateRequest;

final class BankAccountCreateAction
{

    /**
     * @OA\Put(
     *      path="/bankAccount",
     *      tags={"BankAccount"},
     *      description="Create current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="bank_id", type="string", nullable=false),
     *              @OA\Property(property="card_number", type="string", nullable=false),
     *              @OA\Property(property="card_employee_name", type="string", nullable=true),
     *              @OA\Property(property="expired_month", type="int", nullable=true),
     *              @OA\Property(property="expired_year", type="int", nullable=true),
     *              @OA\Property(property="currency_id", type="int", nullable=false),
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
    public function __invoke(BankAccountCreateRequest $request, BankAccountCommandService $service): JsonResponse
    {
        $dto = $request->toDto();

        $service->createBankAccount($dto);

        return response()->message(trans('messages.auth_profile.updated'));
    }
}
