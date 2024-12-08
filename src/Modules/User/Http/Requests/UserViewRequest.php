<?php

namespace Modules\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Dto\UserViewRequestDto;

final class UserViewRequest extends FormRequest
{
    /**
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    /**
     */
    public function toDto(): UserViewRequestDto
    {
        return new UserViewRequestDto($this->user()->id);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
