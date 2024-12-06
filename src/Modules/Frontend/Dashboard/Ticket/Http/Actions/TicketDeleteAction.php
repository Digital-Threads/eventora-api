<?php

namespace Modules\Frontend\Dashboard\Ticket\Http\Actions;

use Exception;
use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Ticket\Services\TicketCommandService;
use Modules\Frontend\Dashboard\Ticket\Http\Requests\TicketDeleteRequest;

final class TicketDeleteAction
{
    /**
     * @OA\Delete(
     *     path="/tickets/{id}",
     *     tags={"Tickets"},
     *     description="Delete an existing ticket",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the ticket to delete"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket deleted successfully",
     *         @OA\JsonContent(type="object", @OA\Property(property="message", type="string", example="Ticket deleted successfully.")),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     ),
     * )
     */
    public function __invoke(TicketDeleteRequest $request, TicketCommandService $service): JsonResponse
    {
        try {
            $dto = $request->toDto();
            $service->delete($dto);

            return response()->message(trans('tickets.deleted.successfully'));
        } catch (Exception) {
            return response()->errorMessage(trans('tickets.delete_failed'));
        }
    }
}
