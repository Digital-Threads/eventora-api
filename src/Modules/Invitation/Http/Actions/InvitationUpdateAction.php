<?php

namespace Modules\Invitation\Http\Actions;

use Modules\Invitation\Checks\UserCanUpdateInvitationCheck;
use Modules\Invitation\Http\Requests\InvitationUpdateRequest;
use Modules\Invitation\Http\Resources\InvitationResource;
use Modules\Invitation\Services\InvitationCommandService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class InvitationUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Put(
     *      path="/invitations/{id}",
     *      tags={"Invitations"},
     *      description="Обновить приглашение",
     *      security={{"passport": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          description="ID приглашения"
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/InvitationSchema")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Приглашение обновлено",
     *          @OA\JsonContent(ref="#/components/schemas/InvitationSchema")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Некорректный запрос",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema")
     *      )
     * )
     * @throws AuthorizationException
     */
    public function __invoke(InvitationUpdateRequest $request, InvitationCommandService $service): JsonResponse
    {
        $this->authorize(UserCanUpdateInvitationCheck::class, [auth()->user(), $request->route('id')]);

        $dto = $request->toDto();
        $invitation = $service->update($dto);

        return new JsonResponse(new InvitationResource($invitation), 200);
    }
}
