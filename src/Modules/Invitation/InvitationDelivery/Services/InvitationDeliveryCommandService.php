<?php

namespace Modules\Invitation\InvitationDelivery\Services;

use Domain\InvitationDelivery\Events\InvitationAccepted;
use Domain\InvitationDelivery\Events\InvitationConsidering;
use Domain\InvitationDelivery\Events\InvitationRejected;
use Domain\InvitationDelivery\Exception\AlreadyRespondedException;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryCommandRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryRespondDto;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliverySendRequestDto;
use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryStatus;
use Modules\Invitation\InvitationDelivery\Enums\InvitationResponseStatus;
use Modules\Invitation\InvitationDelivery\Generators\ShortLinkGenerator;

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
                'url' => $shortLink,
                'status' => InvitationDeliveryStatus::PENDING->value,
                'response_status' => InvitationResponseStatus::NONE->value,
                'retry_count' => 0,
            ];
        }

        return $this->invitationDeliveryCommandRepository->createMultiple($deliveriesData);
    }

    /**
     * @throws Exception
     */
    public function respondToInvitation(
        InvitationDeliveryRespondDto $dto,
        InvitationDelivery $delivery
    ): InvitationDelivery {
        if ($delivery->response_status !== InvitationResponseStatus::NONE->value) {
            throw new AlreadyRespondedException();
        }

        $newStatus = $dto->toEnum();
        $this->invitationDeliveryCommandRepository->updateResponseStatus($delivery, $newStatus);

        match ($newStatus) {
            InvitationResponseStatus::ACCEPTED => Event::dispatch(new InvitationAccepted($delivery)),
            InvitationResponseStatus::REJECTED => Event::dispatch(new InvitationRejected($delivery)),
            InvitationResponseStatus::CONSIDERING => Event::dispatch(new InvitationConsidering($delivery)),
            default => null,
        };

        return $delivery->refresh();
    }
}
