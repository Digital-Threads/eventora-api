<?php

namespace Modules\Auth\AuthGoogle\Http\Requests;

use Modules\Auth\AuthGoogle\Dto\AuthGoogleLinkDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
