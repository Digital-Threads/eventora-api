<?php

namespace Modules\Auth\AuthGoogle\Http\Requests;

use Modules\Auth\AuthGoogle\Dto\AuthGoogleForgetDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthGoogleForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthGoogleForgetDto
    {
        return new AuthGoogleForgetDto(
            Auth::id(),
        );
    }
}
