<?php

namespace Modules\AuthTrustedDevice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Validation\Rules\CurrentPasswordRule;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceDeleteDto;

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
