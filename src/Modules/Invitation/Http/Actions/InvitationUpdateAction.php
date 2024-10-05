<?php

namespace Modules\Invitation\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Invitation\Http\Requests\InvitationUpdateRequest;
use Modules\Invitation\Services\InvitationCommandService;

final class InvitationUpdateAction
{
    /**
     * @OA\Put(
     *      path="/invitations/{id}",
     *      tags={"Invitations"},
     *      description="Обновить приглашение",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="recipientContact", type="string"),
     *              @OA\Property(property="channel", type="string", enum={"email", "sms", "whatsapp", "telegram", "viber", "facebook"}),
     *              @OA\Property(property="message", type="string", nullable=true),
     *              @OA\Property(property="invitationLink", type="string"),
     *              @OA\Property(property="status", type="string", enum={"pending", "sent", "delivered", "failed"})
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Приглашение обновлено",
     *          @OA\JsonContent(type="object", example={"id": 1, "recipient_contact": "test@example.com", "channel": "email", "status": "sent"})
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Некорректный запрос",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(InvitationUpdateRequest $request, InvitationCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitation = $service->update($dto);

        return response()->json($invitation, 200);
    }
}