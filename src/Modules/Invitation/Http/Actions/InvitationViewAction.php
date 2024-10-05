<?php

namespace Modules\Invitation\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Invitation\Http\Requests\InvitationViewRequest;
use Modules\Invitation\Services\InvitationQueryService;

final class InvitationViewAction
{
    /**
     * @OA\Get(
     *      path="/invitations/{id}",
     *      tags={"Invitations"},
     *      description="Получить одно приглашение по ID",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          description="ID приглашения"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Приглашение найдено",
     *          @OA\JsonContent(type="object", example={"id": 1, "event_id": 1, "user_id": null, "recipient_contact": "test@example.com", "channel": "email", "message": "Приглашаем вас!", "invitation_link": "http://example.com", "status": "sent"})
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Приглашение не найдено",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(InvitationViewRequest $request, InvitationQueryService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitation = $service->view($dto);

        return response()->json($invitation, 200);
    }
}