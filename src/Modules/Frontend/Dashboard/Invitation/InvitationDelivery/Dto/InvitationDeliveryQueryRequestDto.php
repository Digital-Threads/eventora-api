<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto;

final readonly class InvitationDeliveryQueryRequestDto
{
    public function __construct(
        public int $invitationId, // ID основного приглашения для фильтрации
        public ?string $status = null, // Фильтр по статусу
        public int $perPage = 10, // Количество записей на странице
        public ?string $cursor = null // Курсор для пагинации
    ) {
    }
}
