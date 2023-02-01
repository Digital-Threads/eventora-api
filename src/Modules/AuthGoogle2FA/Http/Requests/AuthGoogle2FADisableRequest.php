<?php

namespace Modules\AuthGoogle2FA\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FADisableDto;

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
