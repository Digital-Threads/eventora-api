<?php

namespace Modules\Frontend\Dashboard\Invitation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationUpdateRequestDto;

final class InvitationUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'invitationLink' => 'nullable|string|url',
        ];
    }

    public function toDto(): InvitationUpdateRequestDto
    {
        return new InvitationUpdateRequestDto(
            $this->route('id'),
            $this->input('eventId'),
            $this->input('title'),
            $this->input('message'),
            $this->input('invitationLink')
        );
    }
}
