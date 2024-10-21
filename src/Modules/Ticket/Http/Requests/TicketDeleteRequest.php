<?php

namespace Modules\Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Ticket\Dto\TicketDeleteRequestDto;

/**
 * @OA\Schema(
 *     schema="TicketDeleteRequest",
 *     @OA\Property(property="id", type="integer", description="ID of the ticket to delete")
 * )
 */
final class TicketDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:tickets,id',
        ];
    }

    public function toDto(): TicketDeleteRequestDto
    {
        return new TicketDeleteRequestDto($this->input('id'));
    }
}