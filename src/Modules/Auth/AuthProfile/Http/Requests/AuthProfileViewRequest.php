<?php

namespace Modules\Auth\AuthProfile\Http\Requests;

use Modules\Auth\AuthProfile\Dto\AuthProfileViewDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthProfileViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthProfileViewDto
    {
        return new AuthProfileViewDto(
            Auth::id()
        );
    }
}
