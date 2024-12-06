<?php

namespace Modules\Frontend\Dashboard\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Role\Dto\AssignRoleDto;

final class AssignRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function toDto(): AssignRoleDto
    {
        return new AssignRoleDto(
            (int) $this->input('user_id'),
            (int) $this->input('role_id')
        );
    }
}
