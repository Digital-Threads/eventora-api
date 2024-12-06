<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Services\InvitationDeliverySendService;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Services\InvitationDeliveryCommandService;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Requests\InvitationDeliverySendRequest;

final class InvitationDeliverySendAction
{
    private InvitationDeliveryCommandService $invitationDeliveryCommandService;
    private InvitationDeliverySendService $invitationSendService;

    public function __construct(
        InvitationDeliveryCommandService $invitationDeliveryCommandService,
        InvitationDeliverySendService $invitationSendService
    ) {
        $this->invitationDeliveryCommandService = $invitationDeliveryCommandService;
        $this->invitationSendService = $invitationSendService;
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

        return response()->json($deliveries, 201);
    }
}
