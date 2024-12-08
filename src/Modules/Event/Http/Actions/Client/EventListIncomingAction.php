<?php

namespace Modules\Event\Http\Actions\Client;

use Modules\Event\Http\Resources\ClientEventResource;
use Modules\Event\Http\Requests\EventQueryRequest;
use Modules\Event\Services\EventQueryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Get(
 *     path="/client/events/incoming",
 *     tags={"Client Events"},
 *     summary="Получить предстоящие события",
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
final class EventListIncomingAction
{
    public function __invoke(EventQueryRequest $request, EventQueryService $service): AnonymousResourceCollection
    {
        $dto = $request->toDto();
        $events = $service->findIncoming($dto->perPage, $dto->cursor);

        return ClientEventResource::collection($events);
    }
}
