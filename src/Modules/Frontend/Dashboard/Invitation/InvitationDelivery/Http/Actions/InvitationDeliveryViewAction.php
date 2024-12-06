<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Checks\UserCanViewInvitationDeliveryCheck;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Requests\InvitationDeliveryViewRequest;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Resources\InvitationDeliveryResource;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Services\InvitationDeliveryQueryService;

final class InvitationDeliveryViewAction
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *      path="/invitations/delivery/{id}",
     *      tags={"InvitationDelivery"},
     *      description="Получить одно доставленное приглашение по ID",
     *      security={ {"passport": {}} },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          description="ID доставленного приглашения"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Доставленное приглашение найдено",
     *          @OA\JsonContent(ref="#/components/schemas/InvitationDeliverySchema"),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Доставленное приглашение не найдено",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *      )
     * )
     * @throws AuthorizationException
     */
    public function __invoke(InvitationDeliveryViewRequest $request, InvitationDeliveryQueryService $service): JsonResponse
    {
        $this->authorize(UserCanViewInvitationDeliveryCheck::class, auth()->user());

        $dto = $request->toDto();
        $invitationDelivery = $service->view($dto->id);

        return response()->json(new InvitationDeliveryResource($invitationDelivery), 200);
    }
}
