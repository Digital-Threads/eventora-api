<?php

namespace Modules\AuthTrustedDevice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceViewDto;

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
