<?php

namespace Modules\Invitation\InvitationDelivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Invitation\InvitationDelivery\Dto\InvitationDeliveryRespondDto;

final class InvitationDeliveryRespondRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'delivery_id' => ['required', 'exists:invitation_deliveries,id'],
            'response' => ['required', 'in:accepted,rejected,considering'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): InvitationDeliveryRespondDto
    {
        return new InvitationDeliveryRespondDto(
            deliveryId: (int) $this->input('delivery_id'),
            response: $this->input('response')
        );
    }
}
