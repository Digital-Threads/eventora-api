<?php

namespace Modules\Auth\AuthEmail\Http\Requests;

use Modules\Auth\AuthEmail\Dto\AuthEmailUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthEmailUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
        ];
    }

    public function toDto(): AuthEmailUpdateDto
    {
        return new AuthEmailUpdateDto(
            Auth::id(),
            $this->input('email'),
        );
    }
}
