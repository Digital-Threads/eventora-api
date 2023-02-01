<?php

namespace Modules\AuthGoogle2FA\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Validation\Rules\Google2FAOtpRule;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAEnableDto;

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
