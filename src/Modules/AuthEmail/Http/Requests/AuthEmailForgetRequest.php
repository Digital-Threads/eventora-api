<?php

namespace Modules\AuthEmail\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthEmail\Dto\AuthEmailForgetDto;

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
