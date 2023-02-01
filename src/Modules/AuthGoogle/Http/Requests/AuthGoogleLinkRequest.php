<?php

namespace Modules\AuthGoogle\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthGoogle\Dto\AuthGoogleLinkDto;
use Infrastructure\Validation\Rules\GoogleAccessTokenRule;

final class AuthGoogleLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => [
                'required',
                'string',
                'max:255',
                new GoogleAccessTokenRule(),
            ],
        ];
    }

    public function toDto(): AuthGoogleLinkDto
    {
        return new AuthGoogleLinkDto(
            Auth::id(),
            $this->input('token'),
        );
    }
}
