<?php

namespace Modules\Auth\AuthTrustedDevice\Http\Actions;

use Modules\Auth\AuthTrustedDevice\Http\Requests\AuthTrustedDeviceQueryRequest;
use Modules\Auth\AuthTrustedDevice\Http\Resources\AuthTrustedDeviceResource;
use Modules\Auth\AuthTrustedDevice\Services\AuthTrustedDeviceQueryService;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class AuthTrustedDeviceQueryAction
{
    /**
     * @OA\Get(
     *      path="/authTrustedDevice",
     *      tags={"AuthTrustedDevice"},
     *      description="Query user trusted devices",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="cursor",
     *          @OA\Schema(type="string"),
     *          in="query"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\Header(header="x-pagination-per-page", @OA\Schema(type="string", nullable=true)),
     *          @OA\Header(header="x-pagination-previous", @OA\Schema(type="string", nullable=true)),
     *          @OA\Header(header="x-pagination-next", @OA\Schema(type="string", nullable=true)),
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/AuthTrustedDeviceSchema")
     *              ),
     *              @OA\Property(property="schema", type="string"),
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
    public function __invoke(AuthTrustedDeviceQueryRequest $request, AuthTrustedDeviceQueryService $service): ResourceCollection
    {
        $dto = $request->toDto();
        $devices = $service->query($dto);

        return AuthTrustedDeviceResource::collection($devices);
    }
}
