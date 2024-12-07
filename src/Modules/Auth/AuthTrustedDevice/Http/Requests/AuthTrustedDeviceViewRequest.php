<?php

namespace Modules\Auth\AuthTrustedDevice\Http\Requests;

use Modules\Auth\AuthTrustedDevice\Dto\AuthTrustedDeviceViewDto;
use Illuminate\Foundation\Http\FormRequest;

final class AuthTrustedDeviceViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthTrustedDeviceViewDto
    {
        return new AuthTrustedDeviceViewDto(
            $this->route('id'),
        );
    }
}
