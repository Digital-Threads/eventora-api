<?php

namespace Modules\Frontend\Dashboard\Invitation\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Frontend\Dashboard\Invitation\Http\Resources\InvitationResource;
use Modules\Frontend\Dashboard\Invitation\Services\InvitationCommandService;
use Modules\Frontend\Dashboard\Invitation\Checks\UserCanUpdateInvitationCheck;
use Modules\Frontend\Dashboard\Invitation\Http\Requests\InvitationUpdateRequest;

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
