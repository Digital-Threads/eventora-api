<?php

namespace Modules\Auth\AuthEmail\Http\Requests;

use Modules\Auth\AuthEmail\Dto\AuthEmailSendVerificationLinkDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
