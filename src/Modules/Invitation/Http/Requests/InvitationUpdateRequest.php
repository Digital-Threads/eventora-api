<?php

namespace Modules\Invitation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\Dto\InvitationUpdateDto;

final class InvitationUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'recipientContact' => 'required|string',
            'channel' => 'required|string|in:email,sms,whatsapp,telegram,viber,facebook',
            'message' => 'nullable|string',
            'invitationLink' => 'required|string',
            'status' => 'required|string|in:pending,sent,delivered,failed',
        ];
    }

    public function toDto(): InvitationUpdateDto
    {
        return new InvitationUpdateDto(
            $this->route('id'),
            $this->input('recipientContact'),
            $this->input('channel'),
            $this->input('message'),
            $this->input('invitationLink'),
            $this->input('status')
        );
    }
}