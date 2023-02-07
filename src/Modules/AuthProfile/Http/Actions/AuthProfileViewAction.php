<?php

namespace Modules\AuthProfile\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Infrastructure\Eloquent\Models\User;
use Modules\AuthProfile\Services\CompanyTypeQueryService;
use Modules\AuthProfile\Http\Resources\CompanyTypeResource;
use Modules\AuthProfile\Http\Requests\CompanyTypeViewRequest;

final class AuthProfileViewAction
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *      path="/authProfile",
     *      tags={"AuthProfile"},
     *      description="Get current authenticated user profile",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/AuthProfileSchema"),
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
