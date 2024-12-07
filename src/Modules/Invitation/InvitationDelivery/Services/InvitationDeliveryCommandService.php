<?php

namespace Modules\Invitation\InvitationDelivery\Services;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliverySendRequestDto;
use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryStatus;
use Modules\Invitation\InvitationDelivery\Generators\ShortLinkGenerator;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryCommandRepositoryInterface;

// Этот DTO для запроса извне

// Новый DTO для хранения данных

// Импортируем enum

final class InvitationDeliveryCommandService
{
    public function __construct(
        private readonly InvitationDeliveryCommandRepositoryInterface $invitationDeliveryCommandRepository,
        private readonly ShortLinkGenerator $shortLinkGenerator
    ) {
    }

    public function createMultiple(InvitationDeliverySendRequestDto $dto): array
    {
        $deliveriesData = [];
        foreach ($dto->recipients as $recipient) {
            $shortLink = $this->shortLinkGenerator->generate($dto->invitationId, $recipient['id']);

            $deliveriesData[] = [
                'invitation_id' => $dto->invitationId,
                'recipient_contact' => $recipient,
                'channel' => $dto->channel,
                $shortLink,
                'status' => InvitationDeliveryStatus::PENDING->value,
                'retry_count' => 0,
            ];
        }

        return  $this->invitationDeliveryCommandRepository->createMultiple($deliveriesData);
    }
}
