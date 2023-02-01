<?php

namespace Modules\AuthGoogle\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthGoogle\Dto\AuthGoogleForgetDto;

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
