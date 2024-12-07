<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Requests;

use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAForgetDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthGoogle2FAForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthGoogle2FAForgetDto
    {
        return new AuthGoogle2FAForgetDto(
            Auth::id(),
        );
    }
}
