<?php

namespace Modules\Auth\AuthProfile\Http\Actions;

use Modules\Auth\AuthProfile\Http\Requests\AuthProfileViewRequest;
use Modules\Auth\AuthProfile\Http\Resources\AuthProfileResource;
use Modules\Auth\AuthProfile\Services\AuthProfileQueryService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Eloquent\Models\User;

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
