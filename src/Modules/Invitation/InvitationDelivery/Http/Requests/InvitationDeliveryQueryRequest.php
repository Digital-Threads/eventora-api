<?php

namespace Modules\Invitation\InvitationDelivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;

final class InvitationDeliveryQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'invitationId' => 'required|integer|exists:invitations,id',
            'status' => 'nullable|string|in:pending,sent,delivered,failed', // Фильтр по статусу
            'perPage' => 'nullable|integer|min:1|max:100', // Ограничение на количество записей на странице
            'cursor' => 'nullable|string', // Курсор для пагинации
        ];
    }

    public function toDto(): InvitationDeliveryQueryRequestDto
    {
        return new InvitationDeliveryQueryRequestDto(
            $this->input('invitationId'),
            $this->input('status'),
            (int) $this->input('perPage', 10),
            $this->input('cursor')
        );
    }
}
