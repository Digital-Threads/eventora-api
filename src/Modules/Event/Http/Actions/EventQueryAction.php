<?php

namespace Modules\Event\Http\Actions;

use Modules\Event\Services\EventQueryService;
use Modules\Event\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Event\Http\Requests\EventQueryRequest;

final class EventQueryAction
{
    /**
     * @OA\Get(
     *     path="/events",
     *     tags={"Events"},
     *     description="Получение всех мероприятий с фильтром и пагинацией",
     *     security={{"passport": {}} },
     *     @OA\Parameter(
     *         name="categoryId",
     *         in="query",
     *         @OA\Schema(type="integer"),
     *         description="ID категории для фильтрации"
     *     ),
     *     @OA\Parameter(
     *         name="isPublic",
     *         in="query",
     *         @OA\Schema(type="boolean"),
     *         description="Фильтр по публичным мероприятиям"
     *     ),
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         @OA\Schema(type="integer"),
     *         description="Количество записей на странице"
     *     ),
     *     @OA\Parameter(
     *         name="cursor",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="Курсор для пагинации"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/EventSchema")),
     *             @OA\Property(property="pagination", type="object")
     *         ),
     *     ),
     * )
     */
    public function __invoke(EventQueryRequest $request, EventQueryService $service): JsonResource
    {
        $dto = $request->toDto();
        $events = $service->query($dto);

        return EventResource::collection($events);
    }
}
