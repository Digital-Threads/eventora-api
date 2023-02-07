<?php

namespace Modules\AuthProfile\Services;

use Infrastructure\Eloquent\Models\User;
use Modules\AuthProfile\Dto\AuthProfileViewDto;

final class AuthProfileQueryService
{
    public function view(AuthProfileViewDto $request): User
    {
        return User::findOrFail($request->userId);
    }
}
