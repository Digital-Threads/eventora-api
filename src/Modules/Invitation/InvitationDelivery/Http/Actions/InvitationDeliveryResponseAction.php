<?php

namespace Modules\Invitation\InvitationDelivery\Http\Actions;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Modules\Invitation\InvitationDelivery\Checks\UserCanViewInvitationDeliveryCheck;
use Modules\Invitation\InvitationDelivery\Http\Requests\InvitationDeliveryRespondRequest;
use Modules\Invitation\InvitationDelivery\Http\Resources\InvitationDeliveryResource;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliveryCommandService;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliveryQueryService;

final class InvitationDeliveryResponseAction
{
    use AuthorizesRequests;

    /**
     * @throws Exception
     *
     * @OA\Post(
     *     path="/invitations/delivery/respond",
     *     summary="Respond to an invitation (accept / reject / considering)",
     *     tags={"InvitationDelivery"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"delivery_id", "response"},
     *             @OA\Property(property="delivery_id", type="integer", example=123),
     *             @OA\Property(property="response", type="string", enum={"accepted", "rejected", "considering"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Invitation response recorded",
     *         @OA\JsonContent(ref="#/components/schemas/InvitationDeliverySchema")
     *     )
     * )
     */
    public function __invoke(
        InvitationDeliveryRespondRequest $request,
        InvitationDeliveryCommandService $service,
        InvitationDeliveryQueryService $queryService
    ): JsonResponse {
        $this->authorize(UserCanViewInvitationDeliveryCheck::class, auth()->user());

        $dto = $request->toDto();
        $delivery = $queryService->view($dto->deliveryId);
        $delivery = $service->respondToInvitation($dto, $delivery);

        return response()->json(new InvitationDeliveryResource($delivery));
    }
}
