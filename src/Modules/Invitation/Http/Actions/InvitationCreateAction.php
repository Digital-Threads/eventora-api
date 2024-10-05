<?php

namespace Modules\Invitation\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Invitation\Http\Requests\InvitationCreateRequest;
use Modules\Invitation\Services\InvitationCommandService;

final class InvitationCreateAction
{
    /**
     * @OA\Post(
     *      path="/invitations",
     *      tags={"Invitations"},
     *      description="Создать новое приглашение",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="eventId", type="integer"),
     *              @OA\Property(property="userId", type="integer", nullable=true),
     *              @OA\Property(property="recipientContact", type="string"),
     *              @OA\Property(property="channel", type="string", enum={"email", "sms", "whatsapp", "telegram", "viber", "facebook"}),
     *              @OA\Property(property="message", type="string", nullable=true),
     *              @OA\Property(property="invitationLink", type="string"),
     *              @OA\Property(property="status", type="string", enum={"pending", "sent", "delivered", "failed"})
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Приглашение создано",
     *          @OA\JsonContent(type="object", example={"id": 1, "event_id": 1, "user_id": null, "recipient_contact": "test@example.com", "channel": "email", "message": "Приглашаем вас!", "invitation_link": "http://example.com", "status": "pending"})
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Некорректный запрос",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(InvitationCreateRequest $request, InvitationCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitation = $service->create($dto);

        return response()->json($invitation, 201);
    }
}