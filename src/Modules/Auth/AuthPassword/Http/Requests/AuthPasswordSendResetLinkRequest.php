<?php

namespace Modules\Auth\AuthPassword\Http\Requests;

use Modules\Auth\AuthPassword\Dto\AuthPasswordSendResetLinkDto;
use Illuminate\Foundation\Http\FormRequest;

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
