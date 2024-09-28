<?php

namespace Modules\User\Http\Requests;

use Modules\User\Dto\UserViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class UserViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function toDto(): UserViewRequestDto
    {
        return new UserViewRequestDto($this->user()->id);
    }
}