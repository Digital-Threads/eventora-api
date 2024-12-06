<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto\InvitationDeliverySendRequestDto;

/**
 * @OA\Schema(
 *     schema="InvitationDeliverySendRequest",
 *     type="object",
 *     required={"invitationId", "recipients", "channel"},
 *     @OA\Property(
 *         property="invitationId",
 *         type="integer",
 *         example=1,
 *         description="ID of the invitation being sent"
 *     ),
 *     @OA\Property(
 *         property="recipients",
 *         type="array",
 *         @OA\Items(type="string", example="example@example.com"),
 *         description="List of recipients (emails or phone numbers)"
 *     ),
 *     @OA\Property(
 *         property="channel",
 *         type="string",
 *         enum={"email", "sms", "whatsapp", "telegram", "viber", "facebook"},
 *         example="email",
 *         description="The channel through which the invitation will be sent"
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         nullable=true,
 *         example="You are invited to the event!",
 *         description="Custom message to be sent with the invitation"
 *     )
 * )
 */
final class InvitationDeliverySendRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'invitationId' => 'required|integer|exists:invitations,id',
            'recipients' => 'required|array',
            'recipients.*' => 'required|string', // Каждый элемент массива должен быть строкой (email или телефон)
            'channel' => 'required|string|in:email,sms,whatsapp,telegram,viber,facebook',
            'message' => 'nullable|string',
        ];
    }

    public function toDto(): InvitationDeliverySendRequestDto
    {
        return new InvitationDeliverySendRequestDto(
            $this->input('invitationId'),
            $this->input('recipients'),
            $this->input('channel'),
            $this->input('message')
        );
    }
}
