<?php

namespace Modules\Invitation\Http\Requests;

use Modules\Invitation\Dto\InvitationQueryRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class InvitationQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'eventId' => 'required|integer',
        ];
    }

    public function toDto(): InvitationQueryRequestDto
    {
        return new InvitationQueryRequestDto(
            $this->input('eventId')
        );
    }
}
