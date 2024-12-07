<?php

namespace Modules\Auth\AuthProfile\Http\Requests;

use Modules\Auth\AuthProfile\Dto\AuthProfileUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstName' => [
                'required',
                'string',
                'max:255',
            ],
            'lastName' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function toDto(): AuthProfileUpdateDto
    {
        return new AuthProfileUpdateDto(
            Auth::id(),
            $this->input('firstName'),
            $this->input('lastName'),
        );
    }
}
