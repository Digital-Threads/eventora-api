<?php

namespace Modules\HealthCheck\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\HealthCheck\Services\HealthCheckService;

final class HealthCheckAction
{
    /**
     * @OA\Get(
     *      path="/healthCheck",
     *      tags={"HealthCheck"},
     *      summary="Check application health",
     *      description="Returns health status of the application",
     *      @OA\Response(
     *          response=200,
     *          description="Successful response",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Application is healthy"
     *              )
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Unhealthy response",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="error",
     *                  type="string",
     *                  example="Application is unhealthy"
     *              )
     *          ),
     *      ),
     * )
     */
    public function __invoke(HealthCheckService $service): JsonResponse
    {
        $service->healthCheck();

        return response()->json(['message' => trans('messages.http.healthy')]);
    }
}