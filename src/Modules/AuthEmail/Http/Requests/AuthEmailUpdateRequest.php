<?php

namespace Modules\AuthEmail\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthEmail\Dto\AuthEmailUpdateDto;

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
