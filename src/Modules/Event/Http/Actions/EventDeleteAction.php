<?php

namespace Modules\Event\Http\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Infrastructure\Auth\Checks\UserCanDeleteEventCheck;
use Modules\Event\Services\EventCommandService;

final class EventDeleteAction
{
    use AuthorizesRequests;

    /**
     * @OA\Delete(
     *      path="/events/{id}",
     *      tags={"Events"},
     *      description="Delete an existing event",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Event deleted",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Event not found",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(int $id, EventCommandService $service): JsonResponse
    {
        $this->authorize(UserCanDeleteEventCheck::class, auth()->user());

        $service->delete($id);

        return response()->json(null, 204);
    }
}
