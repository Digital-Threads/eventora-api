<?php

namespace Modules\Frontend\Dashboard\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\User\Dto\UserCreateRequestDto;

final class UserCreateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
        ];
    }

    /**
     */
    public function toDto(): UserCreateRequestDto
    {
        return new UserCreateRequestDto(
            $this->input('email'),
            $this->input('password'),
            $this->input('firstName'),
            $this->input('lastName'),
            $this->input('roleId'),
        );
    }
}
