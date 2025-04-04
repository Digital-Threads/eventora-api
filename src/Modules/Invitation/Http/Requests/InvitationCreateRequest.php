<?php

namespace Modules\Invitation\Http\Requests;

use Modules\Invitation\Dto\InvitationCreateRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class InvitationCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'eventId' => 'required|integer|exists:events,id',
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'invitationLink' => 'required|string|url',
        ];
    }

    public function toDto(): InvitationCreateRequestDto
    {
        return new InvitationCreateRequestDto(
            $this->input('eventId'),
            $this->input('title'),
            $this->input('message'),
            $this->input('invitationLink')
        );
    }
}
