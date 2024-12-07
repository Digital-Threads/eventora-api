<?php

namespace Modules\Invitation\InvitationDelivery\Http\Actions;

use Modules\Invitation\InvitationDelivery\Http\Requests\InvitationDeliveryQueryRequest;
use Modules\Invitation\InvitationDelivery\Http\Resources\InvitationDeliveryResource;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliveryQueryService;
use Illuminate\Http\JsonResponse;

final class InvitationDeliveryQueryAction
{
    /**
     * @OA\Get(
     *      path="/invitations/delivery",
     *      tags={"InvitationDelivery"},
     *      description="Получить список доставленных приглашений",
     *      security={ {"passport": {}} },
     *      @OA\Parameter(
     *          name="eventId",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          description="ID события"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Доставленные приглашения найдены",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/InvitationDeliverySchema")),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Приглашения не найдены",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(InvitationDeliveryQueryRequest $request, InvitationDeliveryQueryService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitations = $service->query($dto);

        return response()->json(InvitationDeliveryResource::collection($invitations), 200);
    }
}
