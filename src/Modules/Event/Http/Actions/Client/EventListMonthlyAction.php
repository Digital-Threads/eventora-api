<?php

namespace Modules\Event\Http\Actions\Client;

use Modules\Event\Http\Resources\ClientEventResource;
use Modules\Event\Services\EventQueryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Get(
 *     path="/client/events/monthly",
 *     tags={"Client Events"},
 *     summary="Получить события за текущий месяц",
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ClientEventSchema"))
 *         )
 *     )
 * )
 */
final class EventListMonthlyAction
{
    public function __invoke(EventQueryService $service): AnonymousResourceCollection
    {
        $events = $service->findBetweenDates(
            now()->startOfMonth()->toDateString(),
            now()->endOfMonth()->toDateString(),
            10,
            null
        );

        return ClientEventResource::collection($events);
    }
}
