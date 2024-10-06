<?php

namespace Modules\Invitation\InvitationDelivery\Services;


use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliverySendRequestDto;
use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryStatus;
use Modules\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryCommandRepositoryInterface;

// Этот DTO для запроса извне

// Новый DTO для хранения данных

// Импортируем enum

final class InvitationDeliveryCommandService
{
    public function __construct(
        private readonly InvitationDeliveryCommandRepositoryInterface $invitationDeliveryCommandRepository
    ) {}

    public function createMultiple(InvitationDeliverySendRequestDto $dto): array
    {
        $deliveriesData = [];
        foreach ($dto->recipients as $recipient) {
            $deliveriesData[] = [
                'invitation_id'     => $dto->invitationId,
                'recipient_contact' => $recipient,
                'channel'           => $dto->channel,
                'status'            => InvitationDeliveryStatus::PENDING->value,
                'retry_count'       => 0,
            ];
        }

        return $this->invitationDeliveryCommandRepository->createMultiple($deliveriesData);
    }
}
