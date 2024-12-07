<?php

namespace Modules\Invitation\InvitationDelivery\Http\Requests;

use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class InvitationDeliveryViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:invitations_delivery,id', // ID конкретной записи о доставке
        ];
    }

    public function toDto(): InvitationDeliveryViewRequestDto
    {
        return new InvitationDeliveryViewRequestDto($this->route('id'));
    }
}
