<?php

namespace Infrastructure\HealthCheck\Http\Actions;

use Illuminate\Http\Response;
use Infrastructure\HealthCheck\Checks\AbstractCheck;

final class HealthCheckAction
{
    /**
     * @param  AbstractCheck[] $healthChecks
     * @return void
     */
    public function __construct(
        private array $healthChecks,
    ) {
        //
    }

    /**
     * @OA\Get(
     *      path="/healthCheck",
     *      operationId="healthCheck",
     *      tags={"HealthCheck"},
     *      @OA\Response(
     *          response=204,
     *          description="Successful",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Error",
     *          @OA\JsonContent(type="object", ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(): Response
    {
        foreach ($this->healthChecks as $health) {
            $health->check();
        }

        return response()->noContent();
    }
}
