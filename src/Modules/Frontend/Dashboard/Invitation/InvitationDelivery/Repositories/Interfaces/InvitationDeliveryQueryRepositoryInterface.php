<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;

interface InvitationDeliveryQueryRepositoryInterface
{
    public function query(InvitationDeliveryQueryRequestDto $dto): array; // Возвращает массив доставок
    public function view(int $id): InvitationDelivery; // Получить одну доставку
}
