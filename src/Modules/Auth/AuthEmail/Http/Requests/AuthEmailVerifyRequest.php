<?php

namespace Modules\Auth\AuthEmail\Http\Requests;

use Modules\Auth\AuthEmail\Dto\AuthEmailVerifyDto;
use Illuminate\Foundation\Http\FormRequest;

final class AuthEmailVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'token' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function toDto(): AuthEmailVerifyDto
    {
        return new AuthEmailVerifyDto(
            $this->input('email'),
            $this->input('token'),
        );
    }
}
