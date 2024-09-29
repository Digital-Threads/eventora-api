<?php

namespace Modules\Event\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Event\Http\Requests\EventCreateRequest;
use Modules\Event\Services\EventCommandService;

final class EventCreateAction
{
    /**
     * @OA\Post(
     *      path="/events",
     *      tags={"Events"},
     *      description="Create a new event",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="eventDate", type="string", format="date-time"),
     *              @OA\Property(property="location", type="string", nullable=true),
     *              @OA\Property(property="isPublic", type="boolean"),
     *              @OA\Property(property="categoryId", type="integer", nullable=true),
     *              @OA\Property(property="templateId", type="integer", nullable=true),
     *              @OA\Property(property="companyId", type="integer", nullable=true),
     *              @OA\Property(property="termsConditions", type="string", nullable=true),
     *          ),
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
     */
    public function __invoke(EventCreateRequest $request, EventCommandService $service): JsonResponse
    {
        $dto   = $request->toDto();
        $event = $service->create($dto);

        return response()->json($event, 201);
    }
}