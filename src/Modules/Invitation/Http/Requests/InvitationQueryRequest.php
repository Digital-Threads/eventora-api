<?php

namespace Modules\Invitation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\Dto\InvitationQueryRequestDto;

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
