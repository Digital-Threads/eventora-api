<?php

namespace Modules\EventMetric\Http\Actions;

use Modules\EventMetric\Http\Requests\EventMetricViewRequest;
use Modules\EventMetric\Http\Resources\EventMetricResource;
use Modules\EventMetric\Services\EventMetricQueryService;

final class EventMetricViewAction
{
    public function __construct(
        private readonly EventMetricQueryService $service
    ) {}

    /**
     * @OA\Get(
     *     path="/event-metrics/{eventId}",
     *     tags={"EventMetrics"},
     *     description="Получение метрик по ID события",
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID события",
     *         example=123
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(ref="#/components/schemas/EventMetricSchema")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Событие не найдено",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema")
     *     )
     * )
     */
    public function __invoke(EventMetricViewRequest $request): EventMetricResource
    {
        dd(1);
        $dto = $request->toDto();
        $metrics = $this->service->findByEventId($dto->eventId);

        return new EventMetricResource($metrics);
    }
}
