<?php

namespace Modules\AuthProfile\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthProfile\Dto\AuthProfileUpdateDto;

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
