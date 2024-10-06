<?php

namespace Modules\Invitation\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\Dto\InvitationCreateRequestDto;

final class InvitationCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'eventId'        => 'required|integer|exists:events,id',
            'title'          => 'required|string|max:255',
            'message'        => 'nullable|string',
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
