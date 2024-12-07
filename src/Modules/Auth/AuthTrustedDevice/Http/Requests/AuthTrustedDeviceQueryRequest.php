<?php

namespace Modules\Auth\AuthTrustedDevice\Http\Requests;

use Modules\Auth\AuthTrustedDevice\Dto\AuthTrustedDeviceQueryDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AuthTrustedDeviceQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthTrustedDeviceQueryDto
    {
        return new AuthTrustedDeviceQueryDto(
            Auth::id(),
            $this->query('cursor'),
        );
    }
}
