<?php

namespace Modules\Auth\AuthProfile\Services;

use Modules\Auth\AuthProfile\Dto\AuthProfileViewDto;
use Infrastructure\Eloquent\Models\User;

final class AuthProfileQueryService
{
    public function view(AuthProfileViewDto $request): User
    {
        $user = User::findOrFail($request->userId);
        return $user->load('ownCompanies');
    }
}
