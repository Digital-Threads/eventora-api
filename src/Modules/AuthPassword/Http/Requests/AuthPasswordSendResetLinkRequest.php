<?php

namespace Modules\AuthPassword\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthPassword\Dto\AuthPasswordSendResetLinkDto;

final class AuthPasswordSendResetLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
        ];
    }

    public function toDto(): AuthPasswordSendResetLinkDto
    {
        return new AuthPasswordSendResetLinkDto(
            $this->input('email'),
        );
    }
}
