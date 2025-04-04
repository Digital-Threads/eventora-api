<?php

namespace Modules\Invitation\Http\Actions;

use Modules\Invitation\Http\Requests\InvitationViewRequest;
use Modules\Invitation\Http\Resources\InvitationResource;
use Modules\Invitation\Services\InvitationQueryService;
use Illuminate\Http\JsonResponse;

final class InvitationViewAction
{
    /**
     * @OA\Get(
     *      path="/invitations/{id}",
     *      tags={"Invitations"},
     *      description="Получить одно приглашение по ID",
     *      security={{"passport": {}}},
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
     *          @OA\JsonContent(ref="#/components/schemas/InvitationSchema")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Приглашение не найдено",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema")
     *      )
     * )
     */
    public function __invoke(InvitationViewRequest $request, InvitationQueryService $service): JsonResponse
    {
        $dto = $request->toDto();
        $invitation = $service->view($dto);

        return new JsonResponse(new InvitationResource($invitation), 200);
    }
}
