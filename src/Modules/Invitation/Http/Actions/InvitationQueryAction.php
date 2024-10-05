<?php

namespace Modules\Invitation\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Invitation\Http\Requests\InvitationQueryRequest;
use Modules\Invitation\Services\InvitationQueryService;

final class InvitationQueryAction
{


    /**
     * @OA\Get(
     *      path="/invitations",
     *      tags={"Invitations"},
     *      description="Получить все приглашения для события",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="eventId",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          description="ID события"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Приглашения найдены",
     *          @OA\JsonContent(type="array", @OA\Items(type="object", example={"id": 1, "event_id": 1, "user_id": null, "recipient_contact": "test@example.com", "channel": "email", "message": "Приглашаем вас!", "invitation_link": "http://example.com", "status": "sent"}))
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Приглашения не найдены",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     */
    public function __invoke(InvitationQueryRequest $request, InvitationQueryService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitations = $service->query($dto);

        return response()->json($invitations, 200);
    }
}