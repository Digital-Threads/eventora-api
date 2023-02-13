<?php

namespace Modules\Frontend\Company\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Company\Services\CompanyQueryService;
use Modules\Frontend\Company\Http\Resources\CompanyResource;
use Modules\Frontend\Company\Http\Requests\CompanyViewRequest;

final class CompanyViewAction
{

    /**
     * @OA\Get(
     *      path="/$companies",
     *      tags={"Company"},
     *      description="Get current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/CompanySchema"),
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
    public function __invoke(CompanyViewRequest $request, CompanyQueryService $service, User $user): JsonResource
    {

        $dto = $request->toDto();

        $companiess = $service->view($dto);
        return  CompanyResource::collection($companiess);
    }
}
