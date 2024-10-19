<?php

namespace Modules\Invitation\InvitationDelivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliverySendRequestDto;

final class InvitationDeliverySendRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'invitationId' => 'required|integer|exists:invitations,id',
            'recipients' => 'required|array',
            'recipients.*' => 'required|string', // Каждый элемент массива должен быть строкой (email или телефон)
            'channel' => 'required|string|in:email,sms,whatsapp,telegram,viber,facebook',
            'message' => 'nullable|string',
        ];
    }

    public function toDto(): InvitationDeliverySendRequestDto
    {
        return new InvitationDeliverySendRequestDto(
            $this->input('invitationId'),
            $this->input('recipients'),
            $this->input('channel'),
            $this->input('message')
        );
    }
}
