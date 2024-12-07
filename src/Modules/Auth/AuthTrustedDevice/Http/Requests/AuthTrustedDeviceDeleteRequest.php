<?php

namespace Modules\Auth\AuthTrustedDevice\Http\Requests;

use Modules\Auth\AuthTrustedDevice\Dto\AuthTrustedDeviceDeleteDto;
use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Validation\Rules\CurrentPasswordRule;

final class AuthTrustedDeviceDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'currentPassword' => [
                new CurrentPasswordRule($this->user()),
            ],
        ];
    }

    public function toDto(): AuthTrustedDeviceDeleteDto
    {
        return new AuthTrustedDeviceDeleteDto(
            $this->route('id'),
        );
    }
}
