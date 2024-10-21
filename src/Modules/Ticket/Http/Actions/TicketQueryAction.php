<?php

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Ticket\Services\TicketQueryService;
use Modules\Ticket\Http\Requests\TicketQueryRequest;
use Infrastructure\Http\Resources\AnonymousResourceCollection;
use Modules\Ticket\Http\Resources\TicketResource;

final class TicketQueryAction
{
    /**
     * @OA\Get(
     *     path="/tickets",
     *     tags={"Tickets"},
     *     description="Get all tickets for an event",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="event_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the event"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tickets retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/TicketSchema")),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     )
     * )
     */
    public function __invoke(TicketQueryRequest $request, TicketQueryService $service): AnonymousResourceCollection
    {
        $dto = $request->toDto();
        $tickets = $service->query($dto);

        return TicketResource::collection($tickets);
    }
}