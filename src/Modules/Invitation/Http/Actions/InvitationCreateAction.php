<?php

namespace Modules\Invitation\Http\Actions;

use Modules\Invitation\Checks\UserCanCreateInvitationCheck;
use Modules\Invitation\Http\Requests\InvitationCreateRequest;
use Modules\Invitation\Http\Resources\InvitationResource;
use Modules\Invitation\Services\InvitationCommandService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class InvitationCreateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *      path="/invitations",
     *      tags={"Invitations"},
     *      description="Создать новое приглашение",
     *      security={{"passport": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/InvitationSchema")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Приглашение создано",
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
    public function __invoke(InvitationCreateRequest $request, InvitationCommandService $service): JsonResponse
    {
        $this->authorize(UserCanCreateInvitationCheck::class, auth()->user());

        $dto = $request->toDto();
        $invitation = $service->create($dto);

        return new JsonResponse(new InvitationResource($invitation), 201);
    }
}
