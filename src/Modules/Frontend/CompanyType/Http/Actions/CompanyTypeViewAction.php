<?php

namespace Modules\Frontend\CompanyType\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\CompanyType\Services\CompanyTypeQueryService;
use Modules\Frontend\CompanyType\Http\Resources\CompanyTypeResource;
use Modules\Frontend\CompanyType\Http\Requests\CompanyTypeViewRequest;

final class CompanyTypeViewAction
{

    /**
     * @OA\Get(
     *      path="/companyType",
     *      tags={"CompanyType"},
     *      description="Get current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/CompanyTypeSchema"),
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
    public function __invoke(CompanyTypeViewRequest $request, CompanyTypeQueryService $service, User $user): JsonResource
    {

        $dto = $request->toDto();

        $me = $service->view($dto);

        return new CompanyTypeResource($me);
    }
}
