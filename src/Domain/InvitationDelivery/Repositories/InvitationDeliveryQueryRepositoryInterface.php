<?php

namespace Domain\InvitationDelivery\Repositories;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Infrastructure\Eloquent\Models\InvitationDelivery;

interface InvitationDeliveryQueryRepositoryInterface
{
    public function query(InvitationDeliveryQueryRequestDto $dto): array; // Возвращает массив доставок
    public function view(int $id): InvitationDelivery; // Получить одну доставку
}
