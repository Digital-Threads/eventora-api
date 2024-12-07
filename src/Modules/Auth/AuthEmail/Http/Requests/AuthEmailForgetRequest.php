<?php

namespace Modules\Auth\AuthEmail\Http\Requests;

use Modules\Auth\AuthEmail\Dto\AuthEmailForgetDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthEmailForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthEmailForgetDto
    {
        return new AuthEmailForgetDto(
            Auth::id(),
        );
    }
}
