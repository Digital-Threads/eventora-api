<?php

namespace Modules\Invitation\InvitationDelivery\Repositories;


use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryCreateDto;
use Modules\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryCommandRepositoryInterface;

// Новый DTO

class EloquentInvitationDeliveryCommandRepository implements InvitationDeliveryCommandRepositoryInterface
{
    public function create(InvitationDeliveryCreateDto $dto): InvitationDelivery
    {
        return InvitationDelivery::create([
            'invitation_id'     => $dto->invitationId,
            'recipient_contact' => $dto->recipientContact,
            'channel'           => $dto->channel,
            'url'               => $dto->url,
            'status'            => $dto->status,
            'retry_count'       => $dto->retryCount,
        ]);
    }

    public function createMultiple(array $deliveriesData): array
    {
        return InvitationDelivery::insert($deliveriesData); // Массовая вставка
    }
}
