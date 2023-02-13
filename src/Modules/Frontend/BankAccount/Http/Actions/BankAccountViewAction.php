<?php

namespace Modules\Frontend\BankAccount\Http\Actions;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Frontend\BankAccount\Http\Requests\BankAccountViewRequest;
use Modules\Frontend\BankAccount\Http\Resources\BankAccountResource;
use Modules\Frontend\BankAccount\Services\BankAccountQueryService;

final class BankAccountViewAction
{

    /**
     * @OA\Get(
     *      path="/bankAccount",
     *      tags={"BankAccount"},
     *      description="Get company bankAccounts list",
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
    public function __invoke(BankAccountViewRequest $request, BankAccountQueryService $service, int $companyId): AnonymousResourceCollection
    {
        $dto = $request->toDto();

        $bankAccounts = $service->view($dto, $companyId);

        return BankAccountResource::collection($bankAccounts);
    }
}
