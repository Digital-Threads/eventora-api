<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Requests;

use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAReissueDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthGoogle2FAReissueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthGoogle2FAReissueDto
    {
        return new AuthGoogle2FAReissueDto(
            Auth::id(),
        );
    }
}
