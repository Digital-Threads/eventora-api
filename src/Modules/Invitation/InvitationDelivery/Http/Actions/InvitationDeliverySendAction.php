<?php

namespace Modules\Invitation\InvitationDelivery\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Invitation\InvitationDelivery\Http\Requests\InvitationDeliverySendRequest;
use Modules\Invitation\InvitationDelivery\Http\Resources\InvitationDeliveryResource;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliveryCommandService;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliverySendService;

final class InvitationDeliverySendAction
{
    public function __construct(
        private InvitationDeliveryCommandService $invitationDeliveryCommandService,
        private InvitationDeliverySendService $invitationSendService
    ) {
    }

    /**
     * @OA\Post(
     *      path="/invitations/send",
     *      tags={"Invitations"},
     *      description="Отправить приглашения",
     *      security={{"passport": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/InvitationDeliverySendRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Приглашения отправлены",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/InvitationDeliverySchema")),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Некорректный запрос",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(InvitationDeliverySendRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $deliveries = $this->invitationDeliveryCommandService->createMultiple($dto);

        $this->invitationSendService->sendInvitations($deliveries);

        return response()->json(InvitationDeliveryResource::collection($deliveries), 201);
    }
}
