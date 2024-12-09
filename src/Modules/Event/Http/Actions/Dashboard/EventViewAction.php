<?php

namespace Modules\Event\Http\Actions\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Event\Http\Requests\EventViewRequest;
use Modules\Event\Http\Resources\EventResource;
use Modules\Event\Services\EventQueryService;

final class EventViewAction
{
    /**
     * @OA\Get(
     *     path="/dashboard/events/{id}",
     *     tags={"Events"},
     *     description="Получение одного мероприятия",
     *     security={{"passport": {}} },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID мероприятия"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(ref="#/components/schemas/EventSchema")
     *     )
     * )
     */
    public function __invoke(EventViewRequest $request, EventQueryService $service): JsonResource
    {
        $dto = $request->toDto();
        $event = $service->view($dto);

        return new EventResource($event);
    }
}
