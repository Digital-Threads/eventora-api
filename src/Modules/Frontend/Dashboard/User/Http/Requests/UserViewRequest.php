<?php

namespace Modules\Frontend\Dashboard\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\User\Dto\UserViewRequestDto;

final class UserViewRequest extends FormRequest
{
    /**
     */
    public function rules(): array
    {
        return [];
    }

    /**
     */
    public function toDto(): UserViewRequestDto
    {
        return new UserViewRequestDto($this->user()->id);
    }
}
