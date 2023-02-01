<?php

namespace Modules\AuthEmail\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthEmail\Dto\AuthEmailSendVerificationLinkDto;

final class AuthEmailSendVerificationLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthEmailSendVerificationLinkDto
    {
        return new AuthEmailSendVerificationLinkDto(
            Auth::id(),
        );
    }
}
