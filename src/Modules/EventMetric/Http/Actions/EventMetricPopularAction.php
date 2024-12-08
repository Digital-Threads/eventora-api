<?php

namespace Modules\EventMetric\Http\Actions;

use Modules\EventMetric\Http\Requests\EventMetricPopularRequest;
use Modules\EventMetric\Http\Resources\EventMetricResource;
use Modules\EventMetric\Services\EventMetricQueryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class EventMetricPopularAction
{
    public function __construct(
        private readonly EventMetricQueryService $service
    ) {}

    /**
     * @OA\Get(
     *     path="/event-metrics/popular",
     *     tags={"EventMetrics"},
     *     description="Получение популярных событий по метрикам",
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         @OA\Schema(type="integer"),
     *         description="Количество записей на странице",
     *         example=10
     *     ),
     *     @OA\Parameter(
     *         name="cursor",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="Курсор для пагинации",
     *         example="YXJyYXljb25uZWN0aW9uOjE="
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/EventMetricSchema")),
     *             @OA\Property(property="pagination", type="object")
     *         )
     *     )
     * )
     */
    public function __invoke(EventMetricPopularRequest $request): AnonymousResourceCollection
    {
        $dto = $request->toDto();
        $popularEvents = $this->service->getPopularEvents($dto->perPage, $dto->cursor);

        return EventMetricResource::collection($popularEvents);
    }
}
