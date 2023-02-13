<?php

namespace Modules\Frontend\Bank\Http\Actions;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Frontend\Bank\Http\Requests\BankViewRequest;
use Modules\Frontend\Bank\Http\Resources\BankResource;
use Modules\Frontend\Bank\Services\BankQueryService;

final class BankViewAction
{

    /**
     * @OA\Get(
     *      path="/bank",
     *      tags={"Bank"},
     *      description="Get company banks list",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Property(property="data", ref="#/components/schemas/BankSchema"),
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
    public function __invoke(BankViewRequest $request, BankQueryService $service, int $companyId): AnonymousResourceCollection
    {
        $dto = $request->toDto();

        $banks = $service->view($dto, $companyId);

        return BankResource::collection($banks);
    }
}
