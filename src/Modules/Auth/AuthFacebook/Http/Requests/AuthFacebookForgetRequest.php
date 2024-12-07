<?php

namespace Modules\Auth\AuthFacebook\Http\Requests;

use Modules\Auth\AuthFacebook\Dto\AuthFacebookForgetDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthFacebookForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthFacebookForgetDto
    {
        return new AuthFacebookForgetDto(
            Auth::id(),
        );
    }
}
