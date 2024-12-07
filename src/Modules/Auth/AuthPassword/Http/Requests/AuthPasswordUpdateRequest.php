<?php

namespace Modules\Auth\AuthPassword\Http\Requests;

use Modules\Auth\AuthPassword\Dto\AuthPasswordUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Validation\Rules\CurrentPasswordRule;
use Infrastructure\Validation\Rules\PasswordRule;

final class AuthPasswordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'currentPassword' => [
                new CurrentPasswordRule($this->user()),
            ],
            'password' => [
                'required',
                new PasswordRule(),
            ],
        ];
    }

    public function toDto(): AuthPasswordUpdateDto
    {
        return new AuthPasswordUpdateDto(
            Auth::id(),
            $this->input('password'),
        );
    }
}
