<?php

namespace Modules\Frontend\Dashboard\Ticket\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Ticket\Http\Requests\TicketUpdateRequest;
use Modules\Frontend\Dashboard\Ticket\Services\TicketCommandService;

final class TicketUpdateAction
{
    /**
     * @OA\Put(
     *     path="/tickets/{id}",
     *     tags={"Tickets"},
     *     description="Update an existing ticket",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the ticket to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="type", type="string", nullable=true, description="Ticket type"),
     *             @OA\Property(property="price", type="number", format="float", nullable=true, description="Ticket price"),
     *             @OA\Property(property="quantity", type="integer", nullable=true, description="Quantity of tickets available"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket updated successfully",
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
    public function __invoke(TicketUpdateRequest $request, TicketCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->update($dto);

        return response()->message('tickets.updated.successfully');
    }
}