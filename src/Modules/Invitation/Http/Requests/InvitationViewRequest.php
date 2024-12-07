<?php

namespace Modules\Invitation\Http\Requests;

use Modules\Invitation\Dto\InvitationViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class InvitationViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:invitations,id',
        ];
    }

    public function toDto(): InvitationViewRequestDto
    {
        return new InvitationViewRequestDto(
            $this->route('id')
        );
    }
}
