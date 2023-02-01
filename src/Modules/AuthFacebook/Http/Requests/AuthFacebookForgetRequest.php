<?php

namespace Modules\AuthFacebook\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthFacebook\Dto\AuthFacebookForgetDto;

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
