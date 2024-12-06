<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliveryViewRequestDto;

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
