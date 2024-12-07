<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Requests;

use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FADisableDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthGoogle2FADisableRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthGoogle2FADisableDto
    {
        return new AuthGoogle2FADisableDto(
            Auth::id(),
        );
    }
}
