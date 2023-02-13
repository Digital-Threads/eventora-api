<?php

namespace Modules\Frontend\BankCard\Http\Actions;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Infrastructure\Eloquent\Models\Bank;
use Modules\Frontend\BankCard\Http\Requests\BankCardViewRequest;
use Modules\Frontend\BankCard\Http\Resources\BankCardResource;
use Modules\Frontend\BankCard\Services\BankCardQueryService;

final class BankCardViewAction
{

    /**
     * @OA\Get(
     *      path="/bankCard",
     *      tags={"BankCard"},
     *      description="Get Bank Cards list",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Property(property="data", ref="#/components/schemas/BankCardSchema"),
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
    public function __invoke(BankCardViewRequest $request, BankCardQueryService $service, Bank $bank): AnonymousResourceCollection
    {
        $dto = $request->toDto();

        $bankCards = $service->view($dto, $bank);

        return BankCardResource::collection($bankCards);
    }
}
