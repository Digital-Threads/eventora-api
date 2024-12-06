<?php

namespace Modules\Frontend\Dashboard\Event\Http\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Event\Checks\UserCanDeleteEventCheck;
use Modules\Frontend\Dashboard\Event\Http\Requests\EventDeleteRequest;
use Modules\Frontend\Dashboard\Event\Services\EventCommandService;

final class EventDeleteAction
{
    use AuthorizesRequests;

    /**
     * @OA\Delete(
     *      path="/events/{id}",
     *      tags={"Events"},
     *      description="Delete an existing event",
     *      security={
     *          {"passport": {}} ,
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          description="ID of the event to be deleted"
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
     * @throws AuthorizationException
     */
    public function __invoke(EventDeleteRequest $request, EventCommandService $service): JsonResponse
    {
        $this->authorize(UserCanDeleteEventCheck::class, auth()->user());
        $dto = $request->toDto();
        $service->delete($dto);

        return response()->json(null, 204);
    }
}
