<?php

namespace Modules\AuthFacebook\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthFacebook\Dto\AuthFacebookLinkDto;
use Infrastructure\Validation\Rules\FacebookAccessTokenRule;

final class AuthFacebookLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => [
                'required',
                'string',
                'max:255',
                new FacebookAccessTokenRule(),
            ],
        ];
    }

    public function toDto(): AuthFacebookLinkDto
    {
        return new AuthFacebookLinkDto(
            Auth::id(),
            $this->input('token'),
        );
    }
}
