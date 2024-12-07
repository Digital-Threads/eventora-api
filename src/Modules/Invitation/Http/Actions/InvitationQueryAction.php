<?php

namespace Modules\Invitation\Http\Actions;

use Modules\Invitation\Http\Requests\InvitationQueryRequest;
use Modules\Invitation\Http\Resources\InvitationResource;
use Modules\Invitation\Services\InvitationQueryService;
use Illuminate\Http\JsonResponse;

final class InvitationQueryAction
{
    /**
     * @OA\Get(
     *      path="/invitations",
     *      tags={"Invitations"},
     *      description="Получить все приглашения для события",
     *      security={{"passport": {}}},
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
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/InvitationSchema"))
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Приглашения не найдены",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema")
     *      )
     * )
     */
    public function __invoke(InvitationQueryRequest $request, InvitationQueryService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitations = $service->query($dto);

        return response()->json(InvitationResource::collection($invitations), 200);
    }
}
