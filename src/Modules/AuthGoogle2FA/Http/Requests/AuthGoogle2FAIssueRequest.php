<?php

namespace Modules\AuthGoogle2FA\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAIssueDto;

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
