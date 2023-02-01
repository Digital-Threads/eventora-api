<?php

namespace Modules\AuthProfile\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthProfile\Dto\AuthProfileViewDto;

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
