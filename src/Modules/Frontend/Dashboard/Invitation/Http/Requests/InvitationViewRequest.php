<?php

namespace Modules\Frontend\Dashboard\Invitation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Invitation\Dto\InvitationViewRequestDto;

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
