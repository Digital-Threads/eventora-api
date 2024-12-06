<?php

namespace Modules\Frontend\Dashboard\Event\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Frontend\Dashboard\Event\Http\Resources\EventResource;
use Modules\Frontend\Dashboard\Event\Services\EventCommandService;
use Modules\Frontend\Dashboard\Event\Checks\UserCanCreateEventCheck;
use Modules\Frontend\Dashboard\Event\Http\Requests\EventCreateRequest;

final class EventCreateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/events",
     *      tags={"Events"},
     *      description="Create a new event",
     *      security={
     *          {"passport": {}} ,
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/EventSchema"),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Event created",
     *          @OA\JsonContent(ref="#/components/schemas/EventSchema"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     * @throws AuthorizationException
     */
    public function __invoke(EventCreateRequest $request, EventCommandService $service): JsonResponse
    {
        $this->authorize(UserCanCreateEventCheck::class, auth()->user());

        $dto = $request->toDto();
        $event = $service->create($dto);

        return response()->json(new EventResource($event), 201);
    }
}
