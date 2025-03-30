<?php

namespace Infrastructure\Eloquent\Repositories\InvitationDelivery;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryCommandRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Enums\InvitationResponseStatus;

// Новый DTO

class EloquentInvitationDeliveryCommandRepository implements InvitationDeliveryCommandRepositoryInterface
{
    public function create(InvitationDeliveryCreateDto $dto): InvitationDelivery
    {
        return InvitationDelivery::create([
            'invitation_id' => $dto->invitationId,
            'recipient_contact' => $dto->recipientContact,
            'channel' => $dto->channel,
            'url' => $dto->url,
            'status' => $dto->status,
            'retry_count' => $dto->retryCount,
        ]);
    }

    public function createMultiple(array $deliveriesData): array
    {
        $createdDeliveries = [];

        DB::transaction(function () use ($deliveriesData, &$createdDeliveries) {
            foreach ($deliveriesData as $data) {
                $createdDeliveries[] = InvitationDelivery::create($data);
            }
        });

        return $createdDeliveries;
    }

    public function updateResponseStatus(InvitationDelivery $delivery, InvitationResponseStatus $status): void
    {
        $delivery->response_status = $status;
        $delivery->save();
    }
}
