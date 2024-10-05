<?php

namespace Modules\Invitation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\Dto\InvitationCreateDto;

final class InvitationCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'eventId' => 'required|integer|exists:events,id',
            'userId' => 'nullable|integer|exists:users,id',
            'recipientContact' => 'required|string',
            'channel' => 'required|string|in:email,sms,whatsapp,telegram,viber,facebook',
            'message' => 'nullable|string',
            'invitationLink' => 'required|string',
            'status' => 'required|string|in:pending,sent,delivered,failed',
        ];
    }

    public function toDto(): InvitationCreateDto
    {
        return new InvitationCreateDto(
            $this->input('eventId'),
            $this->input('userId'),
            $this->input('recipientContact'),
            $this->input('channel'),
            $this->input('message'),
            $this->input('invitationLink'),
            $this->input('status')
        );
    }
}