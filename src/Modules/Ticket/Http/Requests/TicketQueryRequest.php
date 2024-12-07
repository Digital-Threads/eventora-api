<?php

namespace Modules\Ticket\Http\Requests;

use Modules\Ticket\Dto\TicketQueryRequestDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="TicketQueryRequest",
 *     @OA\Property(property="event_id", type="integer", description="ID of the event")
 * )
 */
final class TicketQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => 'required|integer|exists:events,id',
        ];
    }

    public function toDto(): TicketQueryRequestDto
    {
        return new TicketQueryRequestDto($this->input('event_id'));
    }
}
