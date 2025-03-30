<?php

namespace Modules\Invitation\InvitationDelivery\Http\Requests;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryQueryRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class InvitationDeliveryQueryRequest extends FormRequest
{
    public function rules(): array
    {
        dd(1);
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
