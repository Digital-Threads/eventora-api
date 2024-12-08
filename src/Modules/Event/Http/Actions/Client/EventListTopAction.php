<?php

namespace Modules\Event\Http\Actions\Client;

use Modules\Event\Http\Resources\ClientEventResource;
use Modules\Event\Services\EventQueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Get(
 *     path="/client/events/top",
 *     tags={"Client Events"},
 *     summary="Получить топ событий",
 *     @OA\Parameter(
 *         name="perPage",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer"),
 *         description="Количество записей на странице"
 *     ),
 *     @OA\Parameter(
 *         name="cursor",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string"),
 *         description="Курсор для пагинации"
 *     ),
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
final class EventListTopAction
{
    public function __invoke(Request $request, EventQueryService $service): AnonymousResourceCollection
    {
        $perPage = $request->query('perPage', 10);
        $cursor = $request->query('cursor');

        $events = $service->findPopular($perPage, $cursor);
        return ClientEventResource::collection($events);
    }
}
