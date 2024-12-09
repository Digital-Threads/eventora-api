<?php

namespace Modules\Event\Http\Actions\Dashboard;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Modules\Event\Checks\UserCanUpdateEventCheck;
use Modules\Event\Http\Requests\EventUpdateRequest;
use Modules\Event\Services\EventCommandService;

final class EventUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Put(
     *      path="/dashboard/events/{id}",
     *      tags={"Events"},
     *      description="Update an existing event",
     *      security={
     *          {"passport": {}} ,
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/EventSchema"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Event updated",
     *          @OA\JsonContent(ref="#/components/schemas/EventSchema"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(EventUpdateRequest $request, EventCommandService $service): JsonResponse
    {
        $this->authorize(UserCanUpdateEventCheck::class, auth()->user());

        $dto = $request->toDto();
        $event = $service->update($dto);

        return response()->json($event, 200);
    }
}
