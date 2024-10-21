<?php

namespace Modules\Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Ticket\Dto\TicketCreateRequestDto;

/**
 * @OA\Schema(
 *     schema="TicketCreateRequest",
 *     required={"event_id", "type", "price", "quantity"},
 *     @OA\Property(property="event_id", type="integer", description="ID of the event"),
 *     @OA\Property(property="type", type="string", description="Ticket type"),
 *     @OA\Property(property="price", type="number", format="float", description="Ticket price"),
 *     @OA\Property(property="quantity", type="integer", description="Ticket quantity"),
 * )
 */
final class TicketCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => 'required|integer|exists:events,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function toDto(): TicketCreateRequestDto
    {
        return new TicketCreateRequestDto(
            $this->input('event_id'),
            $this->input('type'),
            $this->input('price'),
            $this->input('quantity')
        );
    }
}