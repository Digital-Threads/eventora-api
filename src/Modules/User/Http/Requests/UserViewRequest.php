<?php

namespace Modules\User\Http\Requests;

use Modules\User\Dto\UserViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class UserViewRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return UserViewRequestDto
     */
    public function toDto(): UserViewRequestDto
    {
        return new UserViewRequestDto($this->user()->id);
    }
}