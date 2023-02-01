<?php

namespace Modules\AuthGoogle2FA\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAForgetDto;

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
