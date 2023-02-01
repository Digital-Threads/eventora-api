<?php

namespace Modules\AuthGoogle2FA\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAReissueDto;

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
