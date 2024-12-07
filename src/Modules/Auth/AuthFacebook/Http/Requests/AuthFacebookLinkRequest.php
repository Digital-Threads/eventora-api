<?php

namespace Modules\Auth\AuthFacebook\Http\Requests;

use Modules\Auth\AuthFacebook\Dto\AuthFacebookLinkDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
