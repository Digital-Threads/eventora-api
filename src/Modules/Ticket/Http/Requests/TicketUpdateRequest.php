<?php

namespace Modules\Ticket\Http\Requests;

use Modules\Ticket\Dto\TicketUpdateRequestDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="TicketUpdateRequest",
 *     @OA\Property(property="type", type="string", description="Ticket type"),
 *     @OA\Property(property="price", type="number", format="float", description="Ticket price"),
 *     @OA\Property(property="quantity", type="integer", description="Ticket quantity"),
 * )
 */
final class TicketUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'quantity' => 'sometimes|integer|min:1',
        ];
    }

    public function toDto(): TicketUpdateRequestDto
    {
        return new TicketUpdateRequestDto(
            $this->input('id'),
            $this->input('type'),
            $this->input('price'),
            $this->input('quantity')
        );
    }
}
