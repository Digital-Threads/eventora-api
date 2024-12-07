<?php

namespace Modules\Auth\AuthPassword\Http\Requests;

use Modules\Auth\AuthPassword\Dto\AuthPasswordResetDto;
use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Validation\Rules\PasswordRule;

final class AuthPasswordResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'token' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                new PasswordRule(),
            ],
        ];
    }

    public function toDto(): AuthPasswordResetDto
    {
        return new AuthPasswordResetDto(
            $this->input('email'),
            $this->input('token'),
            $this->input('password'),
        );
    }
}
