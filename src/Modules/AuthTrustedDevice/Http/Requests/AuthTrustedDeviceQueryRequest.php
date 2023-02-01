<?php

namespace Modules\AuthTrustedDevice\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceQueryDto;

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
