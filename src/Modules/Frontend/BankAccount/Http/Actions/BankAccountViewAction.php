<?php

namespace Modules\Frontend\BankAccount\Http\Actions;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Infrastructure\Eloquent\Models\Bank;
use Modules\Frontend\BankAccount\Http\Requests\BankAccountViewRequest;
use Modules\Frontend\BankAccount\Http\Resources\BankAccountResource;
use Modules\Frontend\BankAccount\Services\BankAccountQueryService;

final class BankAccountViewAction
{

    /**
     * @OA\Get(
     *      path="/bankAccount",
     *      tags={"BankAccount"},
     *      description="Get Bank Accounts list",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Property(property="data", ref="#/components/schemas/BankAccountSchema"),
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
    public function __invoke(BankAccountViewRequest $request, BankAccountQueryService $service, Bank $bank): AnonymousResourceCollection
    {
        $dto = $request->toDto();

        $bankAccounts = $service->view($dto, $bank);

        return BankAccountResource::collection($bankAccounts);
    }
}
