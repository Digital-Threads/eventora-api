<?php

namespace Modules\Frontend\Dashboard\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\User\Dto\UserUpdateRequestDto;

final class UserUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
        ];
    }

    /**
     */
    public function toDto(): UserUpdateRequestDto
    {
        return new UserUpdateRequestDto(
            $this->input('firstName'),
            $this->input('lastName'),
            $this->input('roleId'),
        );
    }
}
