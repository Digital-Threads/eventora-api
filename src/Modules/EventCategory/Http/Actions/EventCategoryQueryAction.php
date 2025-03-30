<?php

namespace Modules\EventCategory\Http\Actions;

use App\Modules\EventCategory\Http\Resources\EventCategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\EventCategory\Services\EventCategoryQueryService;

/**
 * @OA\Get(
 *     path="/event-category",
 *     tags={" Event Categories"},
 *     summary="Получить категории событий",
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/EventCategorySchema"))
 *         )
 *     )
 * )
 */
final class EventCategoryQueryAction
{
    public function __invoke(EventCategoryQueryService $service): AnonymousResourceCollection
    {
        $eventCategories = $service->query();
        return EventCategoryResource::collection($eventCategories);
    }
}
