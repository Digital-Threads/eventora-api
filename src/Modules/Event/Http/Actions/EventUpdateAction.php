<?php

namespace Modules\Event\Http\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Modules\Event\Checks\UserCanUpdateEventCheck;
use Modules\Event\Services\EventCommandService;
use Modules\Event\Http\Requests\EventUpdateRequest;

final class EventUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Put(
     *      path="/events/{id}",
     *      tags={"Events"},
     *      description="Update an existing event",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string"),
     *              @OA\Property(property="description", type="string", nullable=true),
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
        $this->authorize(UserCanUpdateEventCheck::class,auth()->user());

        $dto = $request->toDto();
        $event = $service->update($dto);

        return response()->json($event, 200);
    }
}
