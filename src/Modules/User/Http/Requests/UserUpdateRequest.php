<?php

namespace Modules\User\Http\Requests;

use Modules\User\Dto\UserUpdateRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstName' => 'nullable|string|max:255',
            'lastName'  => 'nullable|string|max:255',
        ];
    }

    public function toDto(): UserUpdateRequestDto
    {
        return new UserUpdateRequestDto(
            $this->input('firstName'),
            $this->input('lastName'),
            $this->user()->id
        );
    }
}