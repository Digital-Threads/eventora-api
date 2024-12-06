<?php

namespace Modules\Frontend\Dashboard\Ticket\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Ticket\Services\TicketCommandService;
use Modules\Frontend\Dashboard\Ticket\Http\Requests\TicketCreateRequest;

final class TicketCreateAction
{
    /**
     * @OA\Post(
     *     path="/tickets",
     *     tags={"Tickets"},
     *     description="Create a new ticket",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="event_id", type="integer", description="ID of the event"),
     *             @OA\Property(property="type", type="string", description="Ticket type (e.g. 'VIP', 'General Admission')"),
     *             @OA\Property(property="price", type="number", format="float", description="Ticket price"),
     *             @OA\Property(property="quantity", type="integer", description="Quantity of tickets available"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/TicketSchema"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     ),
     * )
     */
    public function __invoke(TicketCreateRequest $request, TicketCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $ticket = $service->create($dto);

        return response()->json(['message' => 'Ticket created successfully.', 'ticket' => $ticket], 200);
    }
}
