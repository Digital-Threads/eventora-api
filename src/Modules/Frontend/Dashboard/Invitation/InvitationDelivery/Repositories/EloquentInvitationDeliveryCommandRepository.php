<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories;

use Illuminate\Support\Facades\DB;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryCommandRepositoryInterface;

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
}
