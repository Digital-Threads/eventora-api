<?php

namespace Modules\Auth\AuthPassword\Http\Requests;

use Modules\Auth\AuthPassword\Dto\AuthPasswordForgetDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Validation\Rules\CurrentPasswordRule;

final class AuthPasswordForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'currentPassword' => [
                new CurrentPasswordRule($this->user()),
            ],
        ];
    }

    public function toDto(): AuthPasswordForgetDto
    {
        return new AuthPasswordForgetDto(
            Auth::id(),
        );
    }
}
