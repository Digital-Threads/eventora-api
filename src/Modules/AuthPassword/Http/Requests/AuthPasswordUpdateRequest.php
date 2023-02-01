<?php

namespace Modules\AuthPassword\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Validation\Rules\PasswordRule;
use Modules\AuthPassword\Dto\AuthPasswordUpdateDto;
use Infrastructure\Validation\Rules\CurrentPasswordRule;

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
