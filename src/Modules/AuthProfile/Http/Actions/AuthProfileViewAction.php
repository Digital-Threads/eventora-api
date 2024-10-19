<?php

namespace Modules\AuthProfile\Http\Actions;

use Infrastructure\Eloquent\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\AuthProfile\Services\AuthProfileQueryService;
use Modules\AuthProfile\Http\Resources\AuthProfileResource;
use Modules\AuthProfile\Http\Requests\AuthProfileViewRequest;

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
     *              ref="#/components/schemas/ErrorSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(AuthProfileViewRequest $request, AuthProfileQueryService $service, User $user): JsonResource
    {
        $dto = $request->toDto();

        $me = $service->view($dto);

        return new AuthProfileResource($me);
    }
}
