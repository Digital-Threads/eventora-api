<?php

namespace Modules\AuthPassword\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthPassword\Dto\AuthPasswordForgetDto;
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
