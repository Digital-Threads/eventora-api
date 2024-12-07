<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Requests;

use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAEnableDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Validation\Rules\Google2FAOtpRule;

final class AuthGoogle2FAEnableRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'otp' => [
                new Google2FAOtpRule($this->user()),
            ],
            'trusted' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function toDto(): AuthGoogle2FAEnableDto
    {
        return new AuthGoogle2FAEnableDto(
            Auth::id(),
            $this->ip(),
            $this->userAgent(),
            $this->input('trusted'),
        );
    }
}
