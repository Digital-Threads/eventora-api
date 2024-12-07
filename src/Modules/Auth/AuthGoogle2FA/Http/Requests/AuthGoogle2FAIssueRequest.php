<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Requests;

use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAIssueDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthGoogle2FAIssueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthGoogle2FAIssueDto
    {
        return new AuthGoogle2FAIssueDto(
            Auth::id(),
        );
    }
}
